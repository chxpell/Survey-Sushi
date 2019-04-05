package edu.fsu.cs.ww2.SurveySushi;

import android.app.Activity;
import android.app.AlertDialog;
import android.content.Context;
import android.content.DialogInterface;
import android.content.Intent;
import android.content.res.ColorStateList;
import android.graphics.Point;
import android.os.Build;
import android.os.Bundle;
import android.support.v4.app.Fragment;
import android.support.v4.app.FragmentManager;
import android.support.v4.app.FragmentTransaction;
import android.support.v4.content.ContextCompat;
import android.support.v7.app.AppCompatActivity;
import android.text.InputType;
import android.view.Display;
import android.view.Gravity;
import android.view.View;
import android.widget.ArrayAdapter;
import android.widget.Button;
import android.widget.EditText;
import android.widget.LinearLayout;
import android.widget.RadioButton;
import android.widget.RadioGroup;
import android.widget.ScrollView;
import android.widget.Spinner;
import android.widget.TextView;
import android.widget.Toast;

import java.util.ArrayList;
import java.util.Arrays;
import java.util.HashMap;
import java.util.Iterator;
import java.util.Map;
import java.util.Timer;
import java.util.TimerTask;

public class SurveyClass extends AppCompatActivity {

    private ScrollView mainView;
    private LinearLayout verticalLayout;
    private Button nextButton, backButton, exitButton;
    private boolean scrolling; // true if the user is touching the screen
    private Survey survey;
    private int currentQuestion, questionIndex;
    private HashMap<String, Question> questions; // Stores each question, seeded by its description
    private HashMap<String, String> answers;     // Stores the answers to each question, seeded by description
    private HashMap<Integer, String> questionMap;   // Stores the description of the question, seeded by its place in line
    private int question_desc = 0; // Keeps a unique description for eac survey
    private Context ctx;

    public SurveyClass() {
        // Default constructor
    }

    @Override
    public void onBackPressed() {
        /*  Disable back button  */;
    }

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_survey_class);

        mainView = (ScrollView) findViewById(R.id.mainView);
        mainView.setPaddingRelative(0,0,0,(int) Math.round(getScreenHeight()/14));
        verticalLayout = (LinearLayout) findViewById(R.id.verticalLayout);
        nextButton = (Button) findViewById(R.id.nextButton);
        nextButton.setHeight((int) Math.round(getScreenHeight()/17));
        backButton = (Button) findViewById(R.id.backButton);
        backButton.setHeight((int) Math.round(getScreenHeight()/17));
        exitButton = (Button) findViewById(R.id.exitButton);
        exitButton.setHeight((int) Math.round(getScreenHeight()/17));

        ctx = (Context) this;
        answers = new HashMap<String, String>(); // Key = question description. Value = answer to question
        questions = new HashMap<String, Question>();    // Key = Question description. Value = Question object
        questionMap = new HashMap<Integer, String>();   // Key = question position in the survey (0,1,2..). Value = question description


        currentQuestion = 0;    // used during execution of survey to keep track of questions
        questionIndex = 0; // used to populate hahsmaps

        /*  Add listeners for buttons in the form */
        addListeners(this);

        /*  Retrieve survey from surveylist and add each question to the view */
        this.survey = (Survey) getIntent().getSerializableExtra("survey_object");

        Iterator it = survey.question_strings.entrySet().iterator();
        while (it.hasNext()) {
            Map.Entry pair = (Map.Entry)it.next();

            /*  This is an ugly one, but it extracts all of the values from the survey and it's question_strings map    */
            addQuestion(ctx, (String) pair.getKey(), String.valueOf(question_desc++), ((ArrayList<String>) pair.getValue()).toArray(new String[((ArrayList<String>) pair.getValue()).size()]));

            it.remove(); // avoids a ConcurrentModificationException
        }

        /*  Add first question to layout. The rest will be added with each click of the next button */
        verticalLayout.addView(questions.get(questionMap.get(0)).getContents());

    }

    /*
     *   Question ID (its place in line)
     *   Question text (What is your gender?)
     *   Question description (one word description used for matching)
     *   Strings for each answer choice
     */
    private void addQuestion(Context context, String title, String description, String...aAnswers)
    {
        Question q = new Question(context, title, description, aAnswers);
        questions.put(q.getDescription(),q);
        questionMap.put(questionIndex++, description);
    }

    /*  Add listeners to buttons and scroll view  */
    private void addListeners(final Context context)
    {
        /*  Go forward one page and increment the current page counter  */
        nextButton.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {

                /*  If the question has no answer, display a toast */
                //if(questions.get(questionMap.get(currentQuestion)).getAnswer() == null) {
                if(questionIsAnswered() == false){
                    Toast toast = Toast.makeText(getApplicationContext(), "Please choose an answer", Toast.LENGTH_SHORT);
                    toast.show();
                }
                /*  Otherwise, add the answer to the map, focus on the next question, and increment the current question counter    */
                else {
                    /*  Automatically overwrite the answer in the answers map   */
                    answers.put(questions.get(questionMap.get(currentQuestion)).getDescription(), questions.get(questionMap.get(currentQuestion)).getAnswer());

                    /*  If we are not at the end of the questions map, we can continue adding them  */
                    if (currentQuestion != questions.size() - 1)
                    {

                        /*  Increment current question counter  */
                        currentQuestion++;

                        /* Add next question to view, only if we are at the last added question (otherwise, the back button has been clicked and we don't want to add a duplicate */
                        if (verticalLayout.findViewById (questions.get(questionMap.get(currentQuestion)).getContents().getId()) == null)
                            verticalLayout.addView(questions.get(questionMap.get(currentQuestion)).getContents());
                    }


                    if(currentQuestion == questions.size()-1) // If we are at the end of the survey, next button turns to submit button
                    {
                        if(!nextButton.getText().equals("SUBMIT"))
                        {
                            nextButton.setText("SUBMIT");
                            nextButton.setBackground(context.getResources().getDrawable(R.drawable.button_rounded_corners_green)); // Rounded rectangle background);
                        }
                        else
                        {
                            AlertDialog alert = createAlertDialog("Would you like to submit your answers and view recommended products?", context);
                            alert.setTitle("Submit and continue?");
                            alert.show();
                        }
                    }

                    /*  Scroll to next question */
                    focusOnView("top");
                }

                /*  Set scrolling to true, so that the scrollChangeListener doesn't interfere with the animation from smoothScrollTo   */
                scroll();


            }// end onClick()
        }); // End listener


        /*  Go back one page and decrement the current page counter */
        backButton.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {

                if(currentQuestion != 0) currentQuestion--;
                focusOnView("top");
                if(nextButton.getText().equals("SUBMIT")) {
                    nextButton.setBackground(ContextCompat.getDrawable(context, R.drawable.button_rounded_corners_orange));
                    nextButton.setText("NEXT");
                }
                scroll();
            }
        });

        /*
         *   The exit button asks for a confirmation before starting the main activity
         */
        exitButton.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                AlertDialog alert = createAlertDialog("Do you want to exit the survey?\nAll progress will be lost", context);
                alert.setTitle("Exit survey?");

                alert.show();
            }
        });


        /*
         *   The survey should only be able to be scrolled through using the next and back buttons.
         *   This touch listener override the standard scroll behavior,
         *   and set boundaries to make sure the user only works on one
         *   question at a time
         */
        if (Build.VERSION.SDK_INT >= Build.VERSION_CODES.M) {
            mainView.setOnScrollChangeListener(new View.OnScrollChangeListener() {
                @Override
                public void onScrollChange(View v, int scrollX, int scrollY, int oldScrollX, int oldScrollY) {

                    /*  Place limits on scroll range for each question  */
                    int maxScroll = (questions.get(questionMap.get(currentQuestion)).getContents().getTop())+300;
                    int minScroll = (questions.get(questionMap.get(currentQuestion)).getContents().getTop())-10;

                    if(scrollY > maxScroll) {   if(!scrolling) mainView.scrollTo(0, maxScroll-1); }
                    if(scrollY < minScroll) {   if(!scrolling) mainView.scrollTo(0, minScroll+1); }
                }
            });

        }


    } // End addListeners()

    private int getScreenHeight()
    {
        if((Activity) ctx == null) return 0;
        Display display = ((Activity) ctx).getWindowManager().getDefaultDisplay();
        Point size = new Point();
        display.getRealSize(size);

        return size.y;
    }

    /*
     *   Smooth scroll to the question at currentQuestion (once it has been incremented/decremented)
     */
    private void focusOnView(final String direction){
        mainView.post(new Runnable() {
            @Override
            public void run() {
                if(direction.equals("top"))
                    mainView.smoothScrollTo(0, mainView.findViewById(questions.get(questionMap.get(currentQuestion)).getContents().getId()).getTop());
                else
                    mainView.smoothScrollTo(0, mainView.findViewById(questions.get(questionMap.get(currentQuestion)).getContents().getId()).getBottom());
            }
        });
    }

    /*  Avoid the scrollchange listener from interfering with animation for 200 ms  */
    private void scroll()
    {
        scrolling = true;
        Timer timer = new Timer();
        timer.schedule(new TimerTask(){
            @Override
            public void run() {
                scrolling = false;
            }
        }, 200);
    }

    /*  Error checking funciton to make sure no fields are empty  */
    private boolean questionIsAnswered()
    {
        Question current = questions.get(questionMap.get(currentQuestion));
        if(current.getAnswer() == null)
            return false;

        return true;
    }

    /*  Function to build a confirmation dialog for the exit/submit buttons */
    private AlertDialog createAlertDialog(String message, final Context ctx)
    {
        AlertDialog.Builder builder = new AlertDialog.Builder(ctx);
        builder.setTitle(R.string.app_name);
        builder.setMessage(message);
        builder.setPositiveButton("Yes", new DialogInterface.OnClickListener() {
            public void onClick(DialogInterface dialog, int id) {
                // Go back to main
                Intent i = new Intent(SurveyClass.this, MainActivity.class);
                startActivity(i);
                dialog.dismiss();
            }
        });
        builder.setNegativeButton("No", new DialogInterface.OnClickListener() {
            public void onClick(DialogInterface dialog, int id) {
                dialog.dismiss();
            }
        });
        AlertDialog alert = builder.create();
        return alert;
    }
}
/**************************************************************************************************/

class Question
{
    private String title, description;
    private ArrayList<String> answers = new ArrayList<String>();
    final Context context;
    private LinearLayout contents;
    private String answer;
    final RadioGroup rg;
    final EditText id_field, num_months_field;
    final Spinner time_field;

    /*  Constructor for normal RadioButton based questions  */
    Question(final Context context, String t, String d, String...a)
    {
        this.context = context;
        this.title = t;
        this.description = d;
        this.answers.addAll(Arrays.asList(a));
        this.id_field = null;
        this.time_field = null;
        this.num_months_field = null;

        /*  Set up vertical layout to hold question title and radiogroup    */
        contents = new LinearLayout(context);
        contents.setMinimumHeight(getScreenHeight());
        contents.setOrientation(LinearLayout.VERTICAL);
        contents.setId(View.generateViewId());

        /*  Create textview to hold question text   */
        TextView titleView = new TextView(context);
        titleView.setPadding(0,200,0,50);
        titleView.setText(title);
        titleView.setTextColor(ContextCompat.getColor(context, R.color.darkGray));
        titleView.setTextSize(28);
        contents.addView(titleView); // Add title to the vertical layout

        /* Create radiogroup and add buttons    */
        rg = new RadioGroup(context);
        rg.setOrientation(RadioGroup.VERTICAL);
        RadioGroup.LayoutParams params
                = new RadioGroup.LayoutParams(context, null);
        params.setMargins(0, 10, 0, 10);

        for(int i = 0; i < answers.size(); i++)
        {
            RadioButton rb = new RadioButton(context);
            rb.setTextColor(ContextCompat.getColor(context, R.color.darkGray));

            /*  Change color of RadioButton circles */
            if (Build.VERSION.SDK_INT >= Build.VERSION_CODES.LOLLIPOP) {
                rb.setButtonTintList(ColorStateList.valueOf(ContextCompat.getColor( context, R.color.colorAccent)));
            }

            /*  Style radioButton  */
            rb.setBackground(context.getResources().getDrawable(R.drawable.radio_style)); // Rounded rectangle background
            rb.setText(answers.get(i));
            rb.setWidth((int) Math.round(getScreenWidth()*.9));
            rb.setHeight((int) Math.round(getScreenHeight()*.08));
            float textSize = 18f;
            rb.setTextSize(textSize / context.getResources().getConfiguration().fontScale);
            //rb.setTextSize(18);
            rb.setLayoutParams(params);
            rg.addView(rb);
        }

        /*  Store the answer in local variable  */
        rg.setOnCheckedChangeListener(new RadioGroup.OnCheckedChangeListener() {
            @Override
            public void onCheckedChanged(RadioGroup group, int checkedId) {
                RadioButton checkedRadioButton = (RadioButton)group.findViewById(checkedId);
                answer = checkedRadioButton.getText().toString();
            }
        });

        /* Add radiogroup to vertical layout  */
        contents.addView(rg);
    }

    /*  Returns the main layout holding the question, so it can be added to the scroll view in the survey */
    public LinearLayout getContents() { return contents; }

    /*  Return the answer to the question as a string   */
    public String getAnswer() { return answer;}

    /*  Return the one word description of the question */
    public String getDescription() { return description;}

    /*  Return title to survey as string    */
    public String getTitle() { return title;}

    /*  Return arraylist of answers */
    public ArrayList<String> getAnswers() { return answers;}
    /*  Set the answer for the question */
    public void setAnswer(String answer)
    {
        this.answer = answer;
    }

    /* Get height of screen */
    private int getScreenHeight()
    {
        Display display = ((Activity) context).getWindowManager().getDefaultDisplay();
        Point size = new Point();
        display.getRealSize(size);

        return size.y;
    }

    /* Get width of screen */
    private int getScreenWidth()
    {
        Display display = ((Activity) context).getWindowManager().getDefaultDisplay();
        Point size = new Point();
        display.getRealSize(size);

        return size.x;
    }

}