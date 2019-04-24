package edu.fsu.cs.ww2.SurveySushi;

import android.support.annotation.NonNull;
import android.util.Log;

import com.google.firebase.database.DataSnapshot;
import com.google.firebase.database.DatabaseError;
import com.google.firebase.database.DatabaseReference;
import com.google.firebase.database.FirebaseDatabase;
import com.google.firebase.database.ValueEventListener;

import java.util.ArrayList;
import java.util.HashMap;

public class DBAccess {
    private DatabaseReference mDatabase;
    private ArrayList<Survey> pulled_surveys; // Stores all surveys from database
    /*  Information for each survey object  */
    private String name;
    private String company;
    private String description;
    private HashMap<String, ArrayList<String>> question_strings; // Stores question title as key, with an arraylist of answer choices as the value

    public DBAccess() {
        mDatabase = FirebaseDatabase.getInstance().getReference();
    }

    public ArrayList<Survey> LoadSurveys() {

        ValueEventListener vel = new ValueEventListener() {
            @Override
            public void onDataChange(DataSnapshot dataSnapshot) {
                System.out.println("~~Please");
                for (DataSnapshot childSnapshot : dataSnapshot.getChildren()) {
                    Survey s = childSnapshot.getValue(Survey.class);
                    s.print();

                }
            }
            @Override
            public void onCancelled(@NonNull DatabaseError dbErr)
            {
                Log.i("CANCELLED", "onCancelled", dbErr.toException());
            }
        };

        mDatabase.addListenerForSingleValueEvent(vel);

        return null;
    }
}
