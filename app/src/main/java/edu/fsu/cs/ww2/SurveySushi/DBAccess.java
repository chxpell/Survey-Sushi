package edu.fsu.cs.ww2.SurveySushi;

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
        mDatabase.addValueEventListener(new ValueEventListener() {
            @Override
            public void onDataChange(DataSnapshot dataSnapshot) {
                for (DataSnapshot childSnapshot : dataSnapshot.getChildren()) {
                    String uid = childSnapshot.getKey();
                    String name = childSnapshot.getValue(String.class);
                    System.out.println("UID: " + uid);
                    System.out.println("NAME: " + name);
                }
            }
            @Override
            public void onCancelled(DatabaseError dbErr)
            {
                Log.i("CANCELLED", "onCancelled", dbErr.toException());
            }
        });

        return null;
    }
}
