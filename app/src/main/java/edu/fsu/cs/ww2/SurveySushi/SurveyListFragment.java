package edu.fsu.cs.ww2.SurveySushi;

import android.app.Activity;
import android.content.Context;
import android.content.Intent;
import android.os.Bundle;
import android.support.annotation.NonNull;
import android.support.annotation.Nullable;
import android.support.design.widget.Snackbar;
import android.support.v4.app.Fragment;
import android.util.Log;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.AdapterView;
import android.widget.ArrayAdapter;
import android.widget.Button;
import android.widget.LinearLayout;
import android.widget.ListView;
import android.widget.TextView;

import com.google.firebase.FirebaseApp;
import com.google.firebase.database.DataSnapshot;
import com.google.firebase.database.DatabaseError;
import com.google.firebase.database.DatabaseReference;
import com.google.firebase.database.FirebaseDatabase;
import com.google.firebase.database.ValueEventListener;

import java.util.ArrayList;
import java.util.Arrays;
import java.util.HashMap;

public class SurveyListFragment extends Fragment {

    private ListView surveyList;
    private ArrayList<Survey> surveys; // Store all available surveys from database
    private LinearLayout surveyListContainer;
    private ArrayAdapter<Survey> adapter;

    @Nullable
    @Override
    public View onCreateView(@NonNull LayoutInflater inflater, @Nullable ViewGroup container, @Nullable Bundle savedInstanceState) {
        View view = inflater.inflate(R.layout.fragment_survey_list, container, false);


        surveyListContainer = view.findViewById(R.id.surveyListContainer);
        surveyList = new ListView(getActivity());
        surveys = new ArrayList<Survey>();

        /* Set button listener  */
        addListeners();

        /*  Create dummy surveys to test the class
         * STEPS TO CREATE A SURVEY MANUALLY:
         *      - Create a HashMap<String, ArrayList<String>>> to hold the question and its answers
         *      - Create ArrayList<String> objects for each question. This ArrayList should hold ONLY the answer choices for hte question
         *      - use put(String, ArrayList) on the HashMap from step 1, where String is the question text itself, and the ArrayList is the list from step 2
         *      - Create a Survey Object with relevant fields from the constructor, and pass the question you created in step 1 as the last parameter
         *      - do surveys.add(Survey) to add the new survey to the ArrayList of surveys
         * TODO: Instead of creating surveys like this, replace this with a method to collect surveys from the database
         */
/*
        HashMap<String, ArrayList<String>> q1 = new HashMap<>();
            ArrayList<String> choices_q1_1 = new ArrayList<String>(Arrays.asList("Hated it", "It was alright", "Loved It"));
            ArrayList<String> choices_q1_2 = new ArrayList<>(Arrays.asList("Not a chance", "Yea, I guess", "Absolutely"));
            q1.put("Did you enjoy using our app?", choices_q1_1);
            q1.put("How likely are you to recommend our app to a friend", choices_q1_2);
        HashMap<String, ArrayList<String>> q2 = new HashMap<>();
            ArrayList<String> choices_q2_1 = new ArrayList<String>(Arrays.asList("I wouldn't", "I would"));
            ArrayList<String> choices_q2_2 = new ArrayList<>(Arrays.asList("Under 18", "18-24", "25-40", "40+"));
            q2.put("Would you recommend this app to a friend?", choices_q2_1);
            q2.put("How old are you?", choices_q2_2);



        Survey s1 = new Survey("satisfaction", "Microsoft", "Ask if customer is satisfied", q1);
        Survey s2 = new Survey("recommendation", "Apple", "Ask if customer would recommend app", q2);
        surveys.add(s1);
        surveys.add(s2);
        */
        DatabaseReference mDatabase = FirebaseDatabase.getInstance().getReference();
        ValueEventListener vel = new ValueEventListener() {
            @Override
            public void onDataChange(DataSnapshot dataSnapshot) {
                for (DataSnapshot childSnapshot : dataSnapshot.getChildren()) {
                    Survey s = childSnapshot.getValue(Survey.class);
                    s.print();
                    s.BuildQuestionArray();
                    surveys.add(s);




                }

                if (surveys.size() == 0) {
                    Snackbar snackbar = Snackbar
                            .make(getActivity().findViewById(android.R.id.content), "No surveys found!", Snackbar.LENGTH_LONG);
                    snackbar.show();
                }

                //---Initialize your adapter as you have fetched the data---\\
                adapter = new surveyAdapter(getContext(), 0, surveys);
                surveyList.setAdapter(adapter);

            }
            @Override
            public void onCancelled(@NonNull DatabaseError dbErr)
            {
                Log.i("CANCELLED", "onCancelled", dbErr.toException());
            }
        };

        mDatabase.addListenerForSingleValueEvent(vel);

        surveyListContainer.addView(surveyList);
        addListeners();
        return view;
    }

    private void addListeners()
    {
        /*  Start SurveyClass activity with the selected Survey */
        surveyList.setOnItemClickListener(new AdapterView.OnItemClickListener() {
            @Override
            public void onItemClick(AdapterView<?> parent, View view, int position, long id) {
                Intent i = new Intent(getActivity(), SurveyClass.class);
                i.putExtra("survey_object", surveys.get(position)); // Pass the selected survey into the intent to be displayed in SurveyClass

                startActivity(i);
            }
        });
    }
}

/*  Custom array adapter to populate list view  */
class surveyAdapter extends ArrayAdapter<Survey> {

    private Context context;
    private ArrayList<Survey> surveys;

    /*  Constructor  */
    public surveyAdapter(Context context, int resource, ArrayList<Survey> objects) {
        super(context, resource, objects);

        this.context = context;
        this.surveys = objects;
    }

    /*  Called when creating list  */
    public View getView(int position, View convertView, ViewGroup parent) {

        //get the property we are displaying
        Survey survey = surveys.get(position);

        //get the inflater and inflate the XML layout for each item
        LayoutInflater inflater = (LayoutInflater) context.getSystemService(Activity.LAYOUT_INFLATER_SERVICE);
        View view = inflater.inflate(R.layout.survey_adapter_layout, null);


        TextView company = (TextView) view.findViewById(R.id.survey_company);
        TextView num_questions = (TextView) view.findViewById(R.id.num_questions);
        TextView survey_desc = (TextView) view.findViewById(R.id.survey_desc);

        /*  Set data fields */
        String company_text = survey.company;
        company.setText(company_text);

        String num_questions_text = String.valueOf(survey.question_strings.size() + " questions");
        num_questions.setText(num_questions_text);

        String desc_text = survey.description;
        survey_desc.setText(desc_text);
        return view;
    }
}
