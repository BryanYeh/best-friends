# Best Friends - Laravel 5.2 Social Network (Facebook)

Followed [youtube](https://www.youtube.com/watch?v=_dd4-HEPejU&list=PL55RiY5tL51oloSGk5XdO2MGjPqc0BxGV) videos, then customized it

- [x] Auth
    - [x] Create Account
    - [x] Login
    - [x] Logout
    - [x] Activation email
    - [x] Reset password
    - [x] Remember Me
- [x] Update Account
- [x] Friends
- [ ] Facebook Theme
    - [x] Home page
    - [ ] Other pages
- [ ] Posts
    - [x] Add (Markdown)
    - [x] Like/Unlike
    - [x] Hate/Unhate
    - [x] Edit
    - [x] Delete
    - [ ] Comment
- [ ] Other stuff

----
##Installation
#### Database and E-mail are required
1. Run `composer install`
2. Update **.env**
    - `DB_` and `MAIL_` are required to be filled out
3. Run `php artisan migrate`
4. Access the app hompage