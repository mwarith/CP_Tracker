# CP-Tracker: Your Competitive Programming Companion

Welcome to **CP-Tracker**, an amazing website designed to help you level up your competitive programming skills. 🚀

## 🌟 Features
- Track your progress in competitive programming.
- Organize and manage your problems and solutions efficiently.
- Gain insights into your coding journey and improve over time.

---

## 🛠️ Installation

Follow these steps to set up CP-Tracker on your local machine:

### Prerequisites
  - [XAMPP](https://www.apachefriends.org/index.html) (or any local server with PHP and MySQL support).

### Steps
1. **Clone this repository** to your local machine.
   ```bash
   git clone https://github.com/mwarith/CP-Tracker.git
  2. **Start XAMPP** and ensure that both Apache and MySQL services are running.

  3. **Navigate to the project directory**:
    ```bash
    cd CP-Tracker
    ```

  4. **Move the project files** to the XAMPP `htdocs` directory:
    ```bash
    mv * /c/xampp/htdocs/CP_Tracker/
    ```

  5. **Import the database**:
    - Open [phpMyAdmin](http://localhost/phpmyadmin/).
    - Create a new database named `cp_tracker`.
    - Import the `cp_tracker.sql` file located in the `database` directory of the project.

  6. **Configure the database connection**:
    - Open the `config.php` file in the project directory.
    - Update the database credentials to match your local setup:
      ```php
      define('DB_SERVER', 'localhost');
      define('DB_USERNAME', 'root');
      define('DB_PASSWORD', '');
      define('DB_NAME', 'cp_tracker');
      ```

  7. **Access the website**:
    - Open your web browser and navigate to [http://localhost/CP_Tracker](http://localhost/CP_Tracker).

  You should now be able to see the CP-Tracker homepage and start using the application.