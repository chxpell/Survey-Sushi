package edu.fsu.cs.ww2.SurveySushi;

import android.app.Activity;
import android.app.ProgressDialog;
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
    private ProgressDialog mProgressDialog;

    @Nullable
    @Override
    public View onCreateView(@NonNull LayoutInflater inflater, @Nullable ViewGroup container, @Nullable Bundle savedInstanceState) {
        View view = inflater.inflate(R.layout.fragment_survey_list, container, false);


        surveyListContainer = view.findViewById(R.id.surveyListContainer);
        surveyList = new ListView(getActivity());
        surveys = new ArrayList<Survey>();

        /* Set button listener  */
        addListeners();

        /*  Show loading dialog */
        mProgressDialog = new ProgressDialog(getContext());
        mProgressDialog.setMessage("Work ...");
        mProgressDialog.show();
        DatabaseReference mDatabase = FirebaseDatabase.getInstance().getReference();
        ValueEventListener vel = new ValueEventListener() {
            @Override
            public void onDataChange(DataSnapshot dataSnapshot) {
                for (DataSnapshot childSnapshot : dataSnapshot.getChildren()) {
                    Survey s = childSnapshot.getValue(Survey.class);
                    s.print();
                    s.BuildQuestionArray();
                    surveys.add(s);
                    mProgressDialog.dismiss();
                }

                if (surveys.size() == 0) {
                    /*  If no surveys are found, print it in a snackbar */
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
                mProgressDialog.dismiss();
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
