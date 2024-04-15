# API

Laravel backend.

## Run Migrations
### Run migrations to create the necessary database tables:

`
php artisan migrate --seed
`

### Run the service:

`
php artisan serve
`

### Run the tests:

`
php artisan test
`

### PASS  Tests\Unit\ExampleTest
  ✓ that true is true

### PASS  Tests\Unit\TodoControllerTest
  ✓ authenticated user can create todo
  ✓ authenticated user can update todo
  ✓ authenticated user can show todo
  ✓ authenticated user can delete todo

### PASS  Tests\Feature\Auth\AuthenticationTest
  ✓ users can authenticate using the login screen
  ✓ users can not authenticate with invalid password

### PASS  Tests\Feature\Auth\EmailVerificationTest
  ✓ email can be verified
  ✓ email is not verified with invalid hash

### PASS  Tests\Feature\Auth\PasswordResetTest
  ✓ reset password link can be requested
  ✓ password can be reset with valid token

### PASS  Tests\Feature\Auth\RegistrationTest
  ✓ new users can register

   PASS  Tests\Feature\ExampleTest
  ✓ the application returns a successful response

### PASS  Tests\Feature\TodoControllerTest
  ✓ it returns all todos for authenticated user
  ✓ it returns single todo
  ✓ it creates new todo
  ✓ it updates existing todo
  ✓ it deletes existing todo

### Tests:  18 passed
### Time:   1.28s
  
# FRONTEND

Vue frontend

## Run 

`
npm run dev
`

### Visit frontend http://localhost:3000
