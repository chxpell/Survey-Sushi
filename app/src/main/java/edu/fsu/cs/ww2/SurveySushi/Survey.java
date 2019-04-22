package edu.fsu.cs.ww2.SurveySushi;


import java.io.Serializable;
import java.util.ArrayList;
import java.util.HashMap;

/*  This class stores one survey from the database  */
public class Survey implements Serializable {
    String name;
    String company;
    String description;
    HashMap<String,ArrayList<String>> question_strings; // Stores question title as key, with an arraylist of answer choices as the value

    public Survey(String name, String company, String description, HashMap<String,ArrayList<String>> question_strings)
    {
        this.name = name;
        this.company = company;
        this.description = description;
        this.question_strings = question_strings;
    }

}