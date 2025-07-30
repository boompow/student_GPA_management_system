# Student GPA Management System

This is another Kuraz-Tech mini-project for backend track. It is a web-based application for managing student GPAs, built with Laravel and Filament. It allows administrators and educators to efficiently track, manage, and analyze student academic performance across courses and semesters.

## Features

- **Student Management:** Add, edit, and view student profiles and academic records.
- **Course Management:** Create and manage courses, assign students, and track enrollments.
- **Semester Tracking:** Organize courses and grades by semester for accurate GPA calculation.
- **GPA Calculation:** Automatically compute student GPAs based on enrolled courses and grades.
- **User Authentication:** Secure login and role-based access for administrators.

![Screenshot](public/build/assets/screenshots/1.PNG)
![Screenshot](public/build/assets/screenshots/2.PNG)
![Screenshot](public/build/assets/screenshots/3.PNG)
![Screenshot](public/build/assets/screenshots/4.PNG)
![Screenshot](public/build/assets/screenshots/5.PNG)
![Screenshot](public/build/assets/screenshots/6.PNG)

## Technologies Used

- Laravel (PHP framework)
- Filament (Admin panel)
- SQLite (default database, configurable)
- Tailwind CSS (styling)
- Vite (asset bundling)

## Folder Structure

- `app/Models`: Eloquent models for Students, Courses, Semesters, Enrollments, Users
- `app/Filament/Resources`: Filament Resources (Course, Semester and Student)
- `app/Filament/Resources/StudentResource/RelationManagers`: Relation Manager under the Student Resource
- `database/migrations`: Database schema migrations

## Author

Boom
