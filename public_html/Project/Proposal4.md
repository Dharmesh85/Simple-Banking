# Project Name: Simple Banking 
## Project Summary: This project will create a bank simulation for users. They’ll be able to have various accounts, do standard bank functions like deposit, withdraw, internal (user’s accounts)/external(other user’s accounts) transfers, and creating/closing accounts.
## Github Link: https://github.com/Dharmesh85/IT202-011/tree/milestone4/public_html/Project
## Project Board Link:https://github.com/Dharmesh85/IT202-011/projects/5 
## Website Link:https://dbp64.herokuapp.com/Project/login.php
## Your Name: Dharmesh Patel

<!--
### Line item / Feature template (use this for each bullet point)
#### Don't delete this

- [x] (12/9//2021) Feature Title (from the proposal bullet point, if it's a sub-point indent it properly)
  -  List of Evidence of Feature Completion
    - Status: Pending (Completed, Partially working, Incomplete, Pending)
    - Direct Link: (Direct link to the file or files in heroku prod for quick testing (even if it's a protected page))
    - Pull Requests
      - PR link #1 (repeat as necessary)
    - Screenshots
      - Screenshot #1 (paste the image so it uploads to github) (repeat as necessary)
        - Screenshot #1 description explaining what you're trying to show
### End Line item / Feature Template
--> 
### Proposal Checklist and Evidence

- Milestone 1
- Milestone 2
- Milestone 3
- Milestone 4
- - [x](12/19/2021) User can set their profile to be public or private (will need another column in Users table)
  -  List of Evidence of Feature Completion
    - Status: Completed
    - Direct Link: https://dbp64.herokuapp.com/Project/Profile.php
    - Pull Requests
      - PR link #1 https://github.com/Dharmesh85/IT202-011/pull/101
    - Screenshots
      - Screenshot #1 <img width="640" alt="Screen Shot 2021-12-21 at 1 42 36 AM" src="https://user-images.githubusercontent.com/77698793/146883964-93b04fde-b42d-495f-bde5-9b64050ebea2.png">
        - Screenshot #1 Able to select Public or private profile 

- [x] (12/19/2021) User will be able open a savings account
  -  List of Evidence of Feature Completion
    - Status: Completed
    - Direct Link: https://dbp64.herokuapp.com/Project/create_account.php
    - Pull Requests
      - PR link #1 https://github.com/Dharmesh85/IT202-011/pull/102
    - Screenshots
      - Screenshot #1 <img width="637" alt="Screen Shot 2021-12-21 at 1 46 48 AM" src="https://user-images.githubusercontent.com/77698793/146884359-abef3256-5d71-41fe-bdfc-2cf87d68206d.png">
        - Screenshot #1 Has the option to create checking or saving account
      - Screenshot #2 <img width="1440" alt="Screen Shot 2021-12-21 at 1 47 11 AM" src="https://user-images.githubusercontent.com/77698793/146884436-d2772761-b86e-46c4-8836-b80d97a0e6d3.png">
        - Screenshot #2 Can see save accounts in account list and APY

- [x] (12/20/2021) User will be able to take out a loan 
  -  List of Evidence of Feature Completion
    - Status: Completed
    - Direct Link: https://dbp64.herokuapp.com/Project/take_loan.php
    - Pull Requests
      - PR link #1 https://github.com/Dharmesh85/IT202-011/pull/103
    - Screenshots
      - Screenshot #1 <img width="573" alt="Screen Shot 2021-12-21 at 2 04 25 AM" src="https://user-images.githubusercontent.com/77698793/146886339-be0c6ed2-7f7f-4f37-b302-70e05b67ad39.png">
        - Screenshot #1 User able to take loan 
       - Screenshot #2 <img width="1440" alt="Screen Shot 2021-12-21 at 1 47 11 AM" src="https://user-images.githubusercontent.com/77698793/146884436-d2772761-b86e-46c4-8836-b80d97a0e6d3.png">
        - Screenshot #2 Can see loan in Accounts list

- [x] (12/20/2021) Listing accounts and/or viewing Account Details should show any applicable APY or “-” if none is set for the particular 19count (may alternatively just hide the display for these types)
  -  List of Evidence of Feature Completion
    - Status: Completed
    - Direct Link: https://dbp64.herokuapp.com/Project/list_accounts.php
    - Pull Requests
      - PR link #1 https://github.com/Dharmesh85/IT202-011/pull/102
    - Screenshots
      - Screenshot #1 <img width="1440" alt="Screen Shot 2021-12-21 at 1 47 11 AM" src="https://user-images.githubusercontent.com/77698793/146884436-d2772761-b86e-46c4-8836-b80d97a0e6d3.png">
        - Screenshot #1 Can see save accounts in account list and APY

- [x] (12/20/2021)User will be able to close an account 
  -  List of Evidence of Feature Completion
    - Status: Complete
    - Direct Link: https://dbp64.herokuapp.com/Project/close_account.php
    - Pull Requests
      - PR link #1 https://github.com/Dharmesh85/IT202-011/pull/105
    - Screenshots
      - Screenshot #1 <img width="745" alt="Screen Shot 2021-12-21 at 2 08 43 AM" src="https://user-images.githubusercontent.com/77698793/146886796-5d1cdd3d-2efd-42cb-9bb0-9538845d9362.png">
        - Screenshot #1  User able to close account with a $0 balance

- [x] (12/20/2021) Admin role (leave this section for last)
  -  List of Evidence of Feature Completion
    - Status: Incomplete
    - Direct Link: https://dbp64.herokuapp.com/admin/list_roles.php
    - Pull Requests
      - PR link #1 https://github.com/Dharmesh85/IT202-011/pull/93
    - Screenshots
      - Screenshot #1 (paste the image so it uploads to github) (repeat as necessary)
        - Screenshot #1 This part was not completed since i was not able to access or see the admin page. Im aware that I will lose points for this and Im aware of that.
- 
### Intructions
#### Don't delete this
1. Pick one project type
2. Create a proposal.md file in the root of your project directory of your GitHub repository
3. Copy the contents of the Google Doc into this readme file
4. Convert the list items to markdown checkboxes (apply any other markdown for organizational purposes)
5. Create a new Project Board on GitHub
   - Choose the Automated Kanban Board Template
   - For each major line item (or sub line item if applicable) create a GitHub issue
   - The title should be the line item text
   - The first comment should be the acceptance criteria (i.e., what you need to accomplish for it to be "complete")
   - Leave these in "to do" status until you start working on them
   - Assign each issue to your Project Board (the right-side panel)
   - Assign each issue to yourself (the right-side panel)
6. As you work
  1. As you work on features, create separate branches for the code in the style of Feature-ShortDescription (using the Milestone branch as the source)
  2. Add, commit, push the related file changes to this branch
  3. Add evidence to the PR (Feat to Milestone) conversation view comments showing the feature being implemented
     - Screenshot(s) of the site view (make sure they clearly show the feature)
     - Screenshot of the database data if applicable
     - Describe each screenshot to specify exactly what's being shown
     - A code snippet screenshot or reference via GitHub markdown may be used as an alternative for evidence that can't be captured on the screen
  4. Update the checklist of the proposal.md file for each feature this is completing (ideally should be 1 branch/pull request per feature, but some cases may have multiple)
    - Basically add an x to the checkbox markdown along with a date after
      - (i.e.,   - [x] (mm/dd/yy) ....) See Template above
    - Add the pull request link as a new indented line for each line item being completed
    - Attach any related issue items on the right-side panel
  5. Merge the Feature Branch into your Milestone branch (this should close the pull request and the attached issues)
    - Merge the Milestone branch into dev, then dev into prod as needed
    - Last two steps are mostly for getting it to prod for delivery of the assignment 
  7. If the attached issues don't close wait until the next step
  8. Merge the updated dev branch into your production branch via a pull request
  9. Close any related issues that didn't auto close
    - You can edit the dropdown on the issue or drag/drop it to the proper column on the project board