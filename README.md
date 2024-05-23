Time Tracking Application - Read Me
 Overview
The Time Tracking Application is a web-based tool designed to help users manage their time efficiently by tracking hours spent on various tasks and projects. This application is built using HTML, CSS, and JavaScript, ensuring a user-friendly interface and responsive design.

Project Structure
The application is structured into several key components:

1. HTML: Provides the basic structure of the application, creating the layout and elements that make up the user interface.
2.CSS: Handles the styling of the application, ensuring that it is visually appealing and easy to navigate. CSS makes the application responsive across different devices.
3. JavaScript: Implements the functionality of the application, including user interactions, data validation, and dynamic content updates.

 Key Features
- User Management: Allows administrators to add, edit, and remove users.
- Task Management: Users can create, edit, and delete tasks.
- Project Management: Facilitates the organization of tasks under various projects.
- Time Tracking: Enables users to log time spent on each task.
- Billing Rates: Associates different billing rates with various tasks or projects.
- Client Management: Stores information about clients for whom projects are being managed.

Database Tables
The application uses several tables to store and manage data:

1. Users: Stores user information, including user ID, name, email, and role.
2. Attendance: Tracks user attendance with fields for user ID, date, check-in, and check-out times.
3.Tasks: Contains details about tasks, including task ID, name, description, project ID, assigned user ID, and status.
4. Projects: Holds project information, such as project ID, name, description, start date, end date, and client ID.
5. BillingRates: Maintains billing rates for tasks and projects, with fields for rate ID, project ID, task ID, rate per hour, and currency.
6. Clients: Stores client details, including client ID, name, contact information, and associated projects.

Public Rules
1.User Authentication: Only registered users can log in and access the system.
2. Role-Based Access Control: Different roles (e.g., admin, manager, user) have varying levels of access and permissions.
3.Data Privacy: User data is protected, and only authorized personnel can view or edit sensitive information.
4.Time Logging: Users must log their hours accurately, with mechanisms in place to prevent fraud.
5. Task and Project Management: Users should only create, edit, or delete tasks and projects relevant to their role and responsibilities.
6. Client Information: Client details must be kept up-to-date and confidential.


Conclusion
The Time Tracking Application is a robust tool designed to streamline time management and project tracking. By leveraging HTML, CSS, and JavaScript, the application provides a seamless user experience, making it an essential tool for teams and individuals aiming to enhance productivity and efficiency.


User:
Hostname: localhost
Username: Niyo
Password: nsiyo123	
Database: time_tracking_application

