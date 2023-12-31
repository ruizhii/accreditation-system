# Accreditation System
This is an accreditation system for Quality Management and Enhancement Centre (QMEC), University of Malaya. 

Objective
----
- Digitalize and simplify the whole accreditation process, which currently is done manually.
- Single source of truth with database instead of multiple excel files across different machines.
- Real-time accreditation progress analysis
- Automated reminder to faculty for accreditation application

Contribution guide
----
Do not use main branch directly, instead use branches and merge the changes in later on.

### Example
To develop a new feature of accreditation form submission:
1. Pull latest main branch
2. Create a new branch named feature/accreditation-form-submission based on lastest main branch
3. Implement the feature and commit changes on the branch
4. Open a pull request when the feature is ready to be merged to main branch
5. (If needed) Have someone review the implementation or conduct discussion
6. Merge the feature branch into main branch

Commit guide: [Conventional Commits](https://www.conventionalcommits.org/en/v1.0.0/)

Setup guide
----
1. Create a .env file, can clone from .env.example
2. Modify the values accordingly, particularly the database info
3. Run `composer install` to install dependencies
4. Run `php artisan migrate` to deploy changes to database
5. (For Laragon) Right click for context-menu and open project website from there

