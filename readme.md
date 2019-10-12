#### The story of this app
It was a project for one of my university courses but I decided to publish it here to help others that need a *Course Management*.

# 🎓 Course management

This is a Laravel app to manage a course, sessions, course students and course exams.

you can also create exams with it's questions and the choices of each question. At the end you can print the exam questions with it's answer sheet.

## ✨ Featues
This project contains 4 sections that explained below:
- **course:**
   - create
   - update
   - delete
   - view / search  
- **session:**
   - create
   - update
   - delete
   - view / search
- **student:**
   - create
   - update
   - delete
   - view / search
   - add to class
   - delete from class
- **exam:**
   - create
   - update
   - delete
   - view / search
   - **question:**
      - add
      - delete
      - update
	  - view
	  - **choice:**
	     - add
		 - delete
		 - update
		 - view



## Rest API
This app provides a rest-api support that you can view a list of them in `routes/api.php`, also uses [🔐 JWT](https://github.com/tymondesigns/jwt-auth "🔐 JWT") for authenticaion.

## License
This repository uses `GNU GPLv3` license which means: lets people do almost anything they want with your project, except distributing closed source versions.