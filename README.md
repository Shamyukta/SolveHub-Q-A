# Eureka-QNA-Application

This project is aimed at building an application that can help people collaborate with each other to help the community in solving critical questions. The main aim of this project is to express my knowledge for applications that use relational database schemas.

Find the schema for each table in the .sql files

# Here is a quick demo of the system

<a href="https://www.youtube.com/watch?v=kKuESN2CIXw" target="_blank"><img src="https://github.com/Rahul-Vasan/Eureka-QNA-Application/blob/main/img/thumbnail.png" 
alt="View Demo Here" width="240" height="180" border="10" /></a>

Click on the image to view demo on youtube



## Table of Contents

- [ER Diagram](#ER)
- [Assumptions](#assumptions)
- [Relational Schema](#schema)
- [Description of the system](#description)
- [Points System](#points)
- [Customized Search Algorithm](#search)
- [Security Features](#security)
- [Challenges Faced](#challenges)
- [Future Scope](#futurescope)
- [Contact Me](#contact)


***

<a id='ER'></a>
## ER Diagram

<p align="center"><img src = "https://github.com/Rahul-Vasan/Eureka-QNA-Application/blob/main/img/ER.png" width = 700><p>
  
<a id='assumptions'></a>
## Assumptions
  
Below are few assumptions that I made in constructing the functionality of the system.
  
1) I do not want to store the first name and last name of the user, assuming display name is more than enough and not many would be keen on revealing identity.
2) Subtopic_id  is global ID for a subtopic throughout the system.
3) There could be the same subtopic name associated with 2 different subtopic_ids .For example programming can a subtopic in the parent topic algorithms and also a subtopic in the parent topic Java with different subtopic_id
4) Each subtopic_id is associated with a parent_topic and the parent_topic_name is unique
  
Incase none of these assumptions make sense right now, nothing to worry, a short description of the entire system is described below and therefore it'll be a lot more clear after going through that part.
  
<a id='schema'></a>
## Relational Schema
  
**users**(display_name, emailhash, passcode, city, state, country,user_level,aboutme, points)

**questions**(question_id, title, body, questioner_display_name, posted_datetime,question_status,resolved_datetime)

  questioner_display_name references users(display_name)

**answers**(answer_id, answer_text,answerer_display_name, question_id, posted_datetime,is_best,is_accepted)

  answerer_display_name references users(display_name)

  question_id references questions(question_id)

**votes**(voter_display_name, answer_id, votetype, votedatetime)

  voter_display_name references users(display_name)

  answer_id references answers(answer_id)

**topics**(subtopic_id,subtopic_name,parent_topic_name)

**question_topic_mapping**(subtopic_id,question_id)

  question_id references questions(question_id)

  subtopic_id references topics(subtopic_id)
  
<a id='description'></a>
## Description Of The System
  
**Modules constituting the overall system**
  
1) User signup
2) User login and logout
3) User edit profile
4) Add a new question and tag the questions with relevant topics
5) View all questions added by me (in a separate window)
6) View all answers added by me ( in a separate window)
7) View all questions

   7.1) For each question in the system: add a new answer, edit my answer, delete my answer, upvote any answer, downvote any answer, flag any answer, also undo any of my current votes.
	
   7.2) For each question added by me: delete question, edit question, add answer,mark answer as best, mark answer as accepted, unmark all of these, mark question as resolved and all the features in 7.1
	
8) View my user level
9) Search for a question or answer based on keywords.
  
## Short Description of each module, screenshots and the query associated with it
  
**1) User Signup module:**

The user signs up to the service. The users table stores the unique display_name, passcode, email address and country as they are required fields. So we only ask the users to enter the required fields. The passcodes are MD5 hashed and stored into the database. He may also have a short description about himself stored under about_me of type longtext, and also enter his state and city, and all these can entered after signing up and logging into the system using the edit profile option in the homepage. Only users signed up for the system can access all the modules of the system. Once the credentials entered during signup is verified the user is asked to log in or if there are any errors the user is prompted with what needs to be corrected. A password mismatch, invalid email format are alerted to the user.
  
**Screenshot**
  
<p align="center"><img src = "https://github.com/Rahul-Vasan/Eureka-QNA-Application/blob/main/img/usersignup.png" width = 700><p>
  
**Associated Query**
  
<p align="center"><img src = "https://github.com/Rahul-Vasan/Eureka-QNA-Application/blob/main/img/usersignupcode.png" width = 700><p>  
  
**2) User Login and Logout module:**
	
The user logs into the system with his unique display_name, passcode.The MD5 passcodes are decoded and compared in the backend. If the display_name or the passcode is wrong , it prompts you to enter a valid display name, or a password mismatch.It also means you havent registered yet and it asks you to register first. Upon logging in to the system, they can see their display_name on the questions/answers asked/answered by them.They can access all other modules of the systems. A logout functionality is also available for the user to log out of the system.It takes the user back to the login/signup page. 

**3) User edit profile:**

This option is provided to the user once he has logged into the system and can be found on the navigation bar of the homepage. All his existing data will be present on the text area and all text areas will be editable. On clicking the submit button the update will happen. 

**Screenshot**
  
<p align="center"><img src = "https://github.com/Rahul-Vasan/Eureka-QNA-Application/blob/main/img/editprofile.png" width = 700><p>
  
**Associated Query**
  
<p align="center"><img src = "https://github.com/Rahul-Vasan/Eureka-QNA-Application/blob/main/img/updateprofilequery.png" width = 700><p>
 
**4) Add a new question and tag the questions with relevant topics**
  
The ask a question on the homepage allows user to ask their question. They need to enter the title and body of the question, and will be alerted if either of them is empty. He also may want to tag his questions with one or more predefined set of topics in the system.Once a question is added, it gets displayed on the homepage immediately for him and other user to view and answer. Adding a questions, shows them under the User’s my questions tab.It also updates the user points by 1 for each question asked. 
  
**Screenshot**
  
<p align="center"><img src = "https://github.com/Rahul-Vasan/Eureka-QNA-Application/blob/main/img/addandtagquestion.png" width = 700><p>
  
**Associated Query**
  
<p align="center"><img src = "https://github.com/Rahul-Vasan/Eureka-QNA-Application/blob/main/img/addandtagquestionquery.png" width = 700><p>
  
**5) View all questions added by me**
  
This is also another option provided to logged in user as part of the navigation bar to view only the questions posted by him with latest questions first. A simple select query on question table to get all questions posted by logged in user which can be found in the session variable would do this.
  
**Screenshot**
  
<p align="center"><img src = "https://github.com/Rahul-Vasan/Eureka-QNA-Application/blob/main/img/myquestions.png" width = 700><p>
  
**Associated Query**
  
<p align="center"><img src = "https://github.com/Rahul-Vasan/Eureka-QNA-Application/blob/main/img/myquestionsquery.png" width = 700><p>
  
**6) View all answers added by me**
  
This is also another option provided to logged in user as part of the navigation bar to view only the answers posted by him. However the questions for which he answered are displayed, and clicking on that will lead him to the next page, where he can see the question title, body, all other answers along with his. He will be able to edit his answer text from here.

**Screenshot**
  
<p align="center"><img src = "https://github.com/Rahul-Vasan/Eureka-QNA-Application/blob/main/img/myanswers.png" width = 700><p>
  
**Associated Query**
  
<p align="center"><img src = "https://github.com/Rahul-Vasan/Eureka-QNA-Application/blob/main/img/myanswersquery.png" width = 700><p>
	
**7) View all questions**

**7.1) For any question in the system:**
	
So on the homepage all the questions of the system are added in reverse chronological order.

**Screenshot:**
	
<p align="center"><img src = "https://github.com/Rahul-Vasan/Eureka-QNA-Application/blob/main/img/homepage.png" width = 700><p>

A logged in user can view all of these questions. But certain features provided to a user are restricted to only the questions added by him. So for all questions of system the generic ability of the user will be to: 

1) Add a new answer
2) Vote for any answer
3) Edit any answer posted by him
4) Delete any answer posted by him
5) Undo any of his current votes
	
<p align="center"><img src = "https://github.com/Rahul-Vasan/Eureka-QNA-Application/blob/main/img/rahulexample.png" width = 700><p>

So this is a question not posted by ‘rahul’ but he has given 2 answers for it. So he will be able to delete all his answers using the delete key and edit his answer using the text area. Also he will able to like dislike or flag any answer from any question but cannot vote 2 different things like like and dislike or dislike and flag for each answer. For each answer there can be only one vote from a particular user. By clicking the same vote again the vote will be removed for that answer ( toggle kind of). And for each question a text area appears at the bottom which can used to add a new answer.
	
<p align="center"><img src = "https://github.com/Rahul-Vasan/Eureka-QNA-Application/blob/main/img/rahulexample2.png" width = 700><p>
	
**7.2) For each question asked by the user, the user gets to have extra features such as:**

1) Edit the question title and body
2) Delete the question
3) Mark the question as resolved
4) Choose a best answer and any number of accepted answers
	
These are additional features to what discussed in the previous section(7.1)
	
<p align="center"><img src = "https://github.com/Rahul-Vasan/Eureka-QNA-Application/blob/main/img/rahulexample3.png" width = 700><p>
	
This is one question asked by ‘rahul’ and he gets the option to edit, delete and mark the question resolved. Additionally he also get to choose the best answer and all accepted answers.
	
<p align="center"><img src = "https://github.com/Rahul-Vasan/Eureka-QNA-Application/blob/main/img/rahulexample4.png" width = 700><p>
	
<a id='points'></a>
	
## Points System
	
For each question asked, for each answer given, for each answer given by me that is accepted or marked as best and for each upvote,downvote and flaggedvote that my answer received my overall points maintained in the users table increases or decreases. And each user’s user_level is mostly based on points and few other special criterias.

**Design:**

**User_level calculation:**

|     | Bronze | Silver | Gold |
| --- | --- | --- | --- |
| Points | 0 - 60 | 60 - 154 | >=155
| No of flagged answers by the user | No restriction | <4 | <2
	
**Points calculations:**
	
| Each Best Answer | Each Accepted Answer | Each Upvote | Each Downvote | Each Question | Each Answer | Each Flagged Answer
| --- | --- | --- | --- | --- | --- | --- |
| +10 | +5 | +2 | -0.5 | +1 | +1 | -1
	
**Explanation for this approach:**
	
Any new user by default belongs to bronze and starts with 0 points.
As he answers each question he gets a point, and similarly if he posts a new question he gets a point.
For each “best answer” he gets 10 points, for each accepted answer he gets 5 points (I don't add points for a best answer as points for best answer + points for accepted answer, because its trivial that a best is obviously accepted, and we treat best answers and accepted answers separately)
For each upvote his answer gets, he gets a +2, for each downvote he gets a -0.5.
Additionally, an answer can be flagged by other users ( which is also a type of vote just like upvote and downvote), just to make sure that the system is free from inappropriate or abusive stuff. For each flagged vote to an answer he gets a -1.
	
**Algorithm for coming up with the thresholds for each user_level:**

**Silver:**

I assume that a silver user should have at least 2 best answers, 2*10 = 20
I also assume that a silver user should have at least 3 accepted answers, 3*5 = 15
I also assume that a silver user should have atleast 5 upvotes , 5*2 = 10
I also assume that a silver user should have atleast posted 15 answers 15*1= 15

Which totals up to 60.

But to check this “at least condition” for each insert into questions, answers, votes through a trigger would involve too many joins and aggregations, which can be costly because these are 3 tables that take in most of the inserts of the system.  So that is why we wanted to move to the points system. Each insert, delete or update into questions, answers and votes will just correspond to an update into the user table updating the points. When the points are updated the triggers starts to do its job of checking the appropriate user_level for the user.

So my minimum expectation is that he gets 60 points to become a silver user, I don't mind him having just 6 answers and each being the best to reach silver, or just 12 accepted answers overall to reach silver, or even 30 upvotes for a single answer to reach silver ( because quality matters more than quantity in our system) or just 60 answers or questions with none of them being accepted or best to encourage the hard work put in.

Additionally we only allow a maximum of 3 flagged answers per silver user, if at all he had 4 flagged answers while he reached 60 points, he will still be a bronze user and he will never get to become a silver user unless someone deletes their flag for his answer.


**Gold:**

I assume that a gold user should have at least 5 best answers, 5*10 = 50
I also assume that a gold user should have at least 9 accepted answers, 9*5 = 45
I also assume that a gold user should have at least 15 upvotes ,15*2 = 30
I also assume that a gold user should have atleast posted 30 answers 30*1= 30
I also assume that a gold user should have atleast posted 2 questions = 2*1 = 2

This sums up to 157 where the 2 points from questions side is mandatory and the remaining 155 points can be achieved in any way using both questions and answers, so its enough to check if a users points is greater than or equal to 155 and check if he has posted at least 2 questions.

Additionally a gold user cannot have more than 1 flagged answer overall, and for each downvote 0.5 points will be reduced. Points incrementing and decrementingon the users table is done in PHP itself after each insert, update or delete to the questions, answers or votes. 
	
But the userlevel is calculated using a trigger in MYSQL.
	
<p align="center"><img src = "https://github.com/Rahul-Vasan/Eureka-QNA-Application/blob/main/img/pointstrigger.png" width = 700><p>
	
**8) View my user level**

Each user is by default a bronze user when he signs in onto the system. Using the predefined set of criteria for granting points given below, the user_level is silver/gold. User can view his user_level  on the homepage.
	
The user level is displayed on the top left of the navigation bar
	
<p align="center"><img src = "https://github.com/Rahul-Vasan/Eureka-QNA-Application/blob/main/img/homepagetop.png" width = 700><p>
	
**9) Search for a question or answer based on keywords**
	
User can also Search for a question or answer from all the pages.
	
**Screenshot:**
	
<p align="center"><img src = "https://github.com/Rahul-Vasan/Eureka-QNA-Application/blob/main/img/search.png" width = 700><p>
	
<a id='search'></a>
	
## Customized Search Algorithm
	
I have used the full text search feature of mysql which creates a full text index on the columns specified from a particular table and matches the given query text against these columns and returns the results sorted by most relevant to least relevance, it uses the cosine distance to do this and is far more accurate when compared to like or contains in a full text search scenario. But the problem with full text indexes is that in mysql it cannot be created on a joined table and if i want to find matches based on both questions and answers then we cannot join questions and answers table to do this. Creating a separate table containing all questions and its corresponding answers would blow up space and can be extremely redundant. So we went for the approach where we full text search on both questions and answers separately. There will be 2 resultant tables containing the search results from both questions and answers along with their question_id in question_results and answer_id, question_id in answers_results.
	
For example: Let me search for this text “How to store data into a database schema” in questions
	
<p align="center"><img src = "https://github.com/Rahul-Vasan/Eureka-QNA-Application/blob/main/img/search1.png" width = 700><p>
	
This would be the result, ques_relevance shows how relevant the results are and I rank them based on it using the windows functions. The most relevant gets the “LARGEST” rank. For example rank 3 is the most relevant question in a result of 3 rows. Lets call this question_result

Similarly we ll get a table for answers also
	
<p align="center"><img src = "https://github.com/Rahul-Vasan/Eureka-QNA-Application/blob/main/img/search2.png" width = 700><p>	
	
Lets call this answer_results.

So I did a FULL OUTER JOIN on both tables using question_id so that questions with no answers in the answer_results and answers with no corresponding questions in the question_results will be retained.

Now we have individual relevances separately for questions and answers joined together. Next we need to combine them together. But I want to give a larger weightage to a question than an answer, because there can always be an answer containing relevant text belonging to a different topic while its question being entirely different and irrelevant. Since users mostly put their search queries in the “question tone” or with semantics more close to questions, I wanted relevant questions to dominate the results while “not” discarding the array of relevant answers.

So we find the total_relevance = question_relevance + 0.1 * answer_relevance

Finally since each question can have multiple answers we group by question_id and sum the total_relevance and order by summed_total_relevance desc.
	
<p align="center"><img src = "https://github.com/Rahul-Vasan/Eureka-QNA-Application/blob/main/img/search3.png" width = 700><p>
	
This is the final result ordered by overall_ranking. And this is were the penalization of answer relevance comes in handy.

My search query was “How to store data into a database schema” but if had not penalized the answer_relevance question id 56 would have been the top result of this search and its question is based on how to store the images of 5 cats(Nothing related to databases). Just because one its answers has 10 “database” keyword repeated, it would have become the top result. This will not happen when the search query has quite a good amount of keywords in it. But for small search strings this problem could occur and penalization of answer_relevance can increase the accuracy drastically.
	
**Screenshot:**
	
<p align="center"><img src = "https://github.com/Rahul-Vasan/Eureka-QNA-Application/blob/main/img/search4.png" width = 700><p>
	
**Search Results Page:**
	
<p align="center"><img src = "https://github.com/Rahul-Vasan/Eureka-QNA-Application/blob/main/img/search5.png" width = 700><p>	
	
**Sessions:**
	
I enabled multiple users to access the system with confined encapsulation using sessions. Sessions are basically used to shared variables throughout the web application and encapsulate with storage for each user. These variables can come handy and relevant when multiple concurrent users are trying to access common variables. Sessioning also enables that we can reuse the data and functionality of a session until the session crashes.
	
Everytime an API call is made to a PHP file and data is being passed or fetches we call the session_start() function and store variables such as username, question_id, answerer_name etc which otherwise would need another query into the database.
	
<a id='security'></a>	
	
## Security features:

I have made sure to make use of the **htmlspecialchars()** function https://www.php.net/manual/en/function.htmlspecialchars.php to handle cross site scripting attacks https://owasp.org/www-community/attacks/xss/ and **prepared statements** https://en.wikipedia.org/wiki/Prepared_statement to avoid sql injections https://owasp.org/www-community/attacks/SQL_Injection.
	
<a id='challenges'></a>	
	
## Challenges Faced:
	
1) The main challenge in this project was to handle the limitations of MYSQL full text search, since it does not support indexing on joined tables and also does not support FULL JOINS.
	
2) Coming up with a robust algorithm for the search feature. Otherwise its a pretty fun and straightforward application.
	
<a id='future'></a>	
	
## Future Scope:
	
1) I would like to improve the search algorithm even more that can make a comprehensive improvement in semantic identification.
	
2) I would also like to improve the frontend with some responsive web technologies incorporated.
	
3) I am also looking forward to hosting the website online so that it can get realtime suggestions from the users themselves.
	
<a id='contact'></a>
## Contact Me

  Please feel free to contact me for anything in pertinance to the project. 
  
| Contact Method |  |
| --- | --- |
| Personal Email | rahulvasan30@gmail.com |
| School Email |   rs7671@nyu.edu |
| LinkedIn | https://www.linkedin.com/in/rahul-vasan/ |  	
	
	
	
	
	
	
	
	


	
	
	

	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
  
  
  
  
  
  
  
  
  
  
  
  

  

  
  
  
  
  
  
  
  

