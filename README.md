# Laravel To-Do List Application

A simple yet feature-rich task management application built with Laravel that allows users to create, manage, and organize their daily tasks.

## Features

- Create new tasks
- Mark tasks as completed or active (toggle functionality)
- Delete individual tasks
- Filter tasks by status (All, Active, Completed)
- Clear all completed tasks at once
- Task counter
- Responsive design using Bootstrap 5

## Requirements

- PHP 8.0 or higher
- Composer
- MySQL or another compatible database
- Laravel 9.x or 10.x

## Installation

1. clone repo

2. Install dependencies
   ```
   composer install
   ```

3. Configure environment variables
   ```
   cp .env.example .env
   php artisan key:generate
   ```

4. Update the `.env` file with your database credentials
   ```
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=todo_list
   DB_USERNAME=your_username
   DB_PASSWORD=your_password
   ```

5. Run database migrations
   ```
   php artisan migrate
   ```

6. Start the development server
   ```
   php artisan serve
   ```

7. Visit `http://localhost:8000` in your browser

## Usage

### Adding Tasks
Enter a task name in the input field and click "Add Task" or press Enter.

### Completing Tasks
There are two ways to mark a task as completed:
- Check the checkbox next to the task (automatically submits)
- Click the "Mark as Completed" button next to the task

### Filtering Tasks
Use the tabs at the top of the task list to filter:
- All: Shows all tasks
- Active: Shows only incomplete tasks
- Completed: Shows only completed tasks

### Deleting Tasks
Click the "Delete" button next to a task to remove it.

### Clearing Completed Tasks
Click the "Clear Completed" button at the bottom of the list to remove all completed tasks at once.

## Project Structure

- `routes/web.php`: Contains all routes
- `app/Models/Task.php`: Task model
- `app/Http/Controllers/TaskController.php`: Controller with task logic
- `database/migrations/xxxx_xx_xx_create_tasks_table.php`: Database schema
- `resources/views/tasks/index.blade.php`: Main view

## License

This project is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

## Acknowledgements

- [Laravel](https://laravel.com/)
- [Bootstrap](https://getbootstrap.com/)
