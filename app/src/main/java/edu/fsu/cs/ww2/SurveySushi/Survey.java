package edu.fsu.cs.ww2.SurveySushi;


import java.io.Serializable;
import java.util.ArrayList;
import java.util.HashMap;
import java.util.List;
import java.util.Map;

/*  This class stores one survey from the database  */
public class Survey implements Serializable {
    String name;
    String company;
    String description;
    String num_questions;
    String user;
    long surveyid;
    //Map<String, Map<String,String>> question_answers;
    //Map<String,String> question_descriptions;
    List<List<String>> question_answers = new ArrayList();
    List<String> question_descriptions = new ArrayList();
    HashMap<String,ArrayList<String>> question_strings; // Stores question title as key, with an arraylist of answer choices as the value

    public Survey() { }

    public Survey(String name, String company, String description, HashMap<String,ArrayList<String>> question_strings)
    {
        this.name = name;
        this.company = company;
        this.description = description;
        this.question_strings = question_strings;
    }

    public void print()
    {
        System.out.println("Name: " + name);
        System.out.println("Company: " + company);
        System.out.println("Description: " + description);
        System.out.println("Num questions: " + num_questions);
        System.out.println("User: " + user);
        System.out.println("Survey id: " + surveyid);
        for(int i = 0; i < question_descriptions.size(); i++)
        {
            System.out.println(question_descriptions.get(i));
            for(int j = 0; j < question_answers.get(i).size(); j++)
            {
                System.out.println("\t" + question_answers.get(i).get(j));
            }
        }

    }

    public void setName(String name) { this.name = name; }
    public void setCompany(String company) { this.company = company;}
    public void setDescription(String description) { this.description = description;}
    public void setNumQuestions(String num) { this.num_questions = num;}
    public void setUser(String user) { this.user = user;}


    public String getName() { return this.name;}
    public String getCompany() { return this.company;}
    public String getDescription() { return this.description;}
    public String getnum_questions() { return this.num_questions;}
    public String getUser() { return this.user;}
    public List<String> getquestion_descriptions() {return this.question_descriptions;}
    public List<List<String>> getquestion_answers() { return this.question_answers;}
}