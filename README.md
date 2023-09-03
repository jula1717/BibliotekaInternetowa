# Internet Library

Internet Library is an online library with three levels of access: administrator, employee, and reader. Each type of account offers different functionalities.

## Account Functionalities:

### Administrator:

-Managing employees.

-Full access to the control panel.

### Employee:

-Adding and modifying categories, publishers, and authors.

-Borrowing book copies.

-Handling returns.

-Editing book details.

-Full access to the control panel.

### Reader:

-Browsing the catalog of books.

-Viewing details of book copies.

-Borrowing books.

-One-time extension of borrowings.

-A borrowing limit that increases with the number of books read.

-The Internet Library application allows for easy library management and provides diverse features tailored to the needs of different user types.

## Features examples

The registration window looks similar to the login window. Tooltips provide hints and requirements for the entered data.

<img width="356" alt="Registration Window" src="https://github.com/jula1717/BibliotekaInternetowa/assets/82888111/7fc13d2d-5261-4da2-b04d-73d8afbb0171">

<br><br>

An administrator panel for managing categories, authors, publishers, and employees. Clicking on each tile opens corresponding lists, where you can add, edit, or delete elements.

<img width="378" alt="Control Panel - Administrator" src="https://github.com/jula1717/BibliotekaInternetowa/assets/82888111/bb7e38bb-97d3-410c-bb08-2d8926b0c5dc">

<br><br>

The window allows for adding a book, and the edit window looks similar. The windows for editing and adding categories, publishers, or authors were designed on a similar principle.

<img width="268" alt="Add Book" src="https://github.com/jula1717/BibliotekaInternetowa/assets/82888111/fd9cfe53-ca35-43fa-9c66-13f7bc47c75c">

<br><br>

A catalog of books from the perspective of employees and administrators (readers don't have the ability to edit or delete items from the list). From the catalog view, it's possible to navigate to a specific book title. From there, you can see all copies of that title and have the option to lend the book to a reader.

<img width="946" alt="Catalog" src="https://github.com/jula1717/BibliotekaInternetowa/assets/82888111/d9c19c59-7a8f-4805-bc45-a63fa475876e">

<br><br>

Clicking on "Czytelnicy" in the control panel leads to a list of all readers.

<img width="391" alt="List Of Readers" src="https://github.com/jula1717/BibliotekaInternetowa/assets/82888111/d630582c-7a39-4a52-8639-3b6b035a204c">

<br><br>

Clicking on a user's email in the reader list leads to their account, which includes the borrowing history and a key functionality, receiving returned books.

<img width="940" alt="reader history" src="https://github.com/jula1717/BibliotekaInternetowa/assets/82888111/27d499ce-a2ab-4786-99f6-6b791013623e">

## Installation
### Prerequisites:

Ensure you have PHP and a web server (e.g., Apache, Nginx) installed on your system.

Install PostgreSQL on your server if not already installed.

### Setting Up the Web Application:

Clone the project's repository to your local machine or web server:

```
git clone https://github.com/jula1717/BibliotekaInternetowa.git
```
Navigate to the project directory and change the database credentials in configuration file for your database connection (config.php)

Start your web server.

Accessing the Web Application:

Open a web browser and navigate to the URL where your application is hosted (e.g., http://localhost/BibliotekaInternetowa).
