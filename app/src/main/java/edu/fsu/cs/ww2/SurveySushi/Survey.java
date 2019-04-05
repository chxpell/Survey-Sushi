package edu.fsu.cs.ww2.SurveySushi;

import java.util.ArrayList;

/*  This class stores one survey from the database  */
public class Survey {
    String name;
    String company;
    String description;
    ArrayList<Question> questions;

    public Survey(String name, String company, String description, ArrayList<Question> questions)
    {
        this.name = name;
        this.company = company;
        this.description = description;
        this.questions = questions;
    }
}
