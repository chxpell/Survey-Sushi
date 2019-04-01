package edu.fsu.cs.ww2.SurveySushi;

import android.content.Intent;
import android.os.Bundle;
import android.support.annotation.NonNull;
import android.support.annotation.Nullable;
import android.support.v4.app.Fragment;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.Button;

public class SurveyListFragment extends Fragment implements View.OnClickListener {

    private Button startButton;

    @Nullable
    @Override
    public View onCreateView(@NonNull LayoutInflater inflater, @Nullable ViewGroup container, @Nullable Bundle savedInstanceState) {
        View view = inflater.inflate(R.layout.fragment_survey_list, container, false);
        startButton = (Button) view.findViewById(R.id.startButton);
        startButton.setOnClickListener(this);

        return view;
    }

    @Override
    public void onClick(View v) {
        switch (v.getId()) {
            case R.id.startButton:
                Intent myIntent = new Intent(getContext(), SurveyClass.class);
                startActivity(myIntent);
                break;
        }
    }
}
