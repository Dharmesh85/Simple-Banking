# Project Name: 
## Project Summary: This project will create a bank simulation for users. They’ll be able to have various accounts, do standard bank functions like deposit, withdraw, internal (user’s accounts)/external(other user’s accounts) transfers, and creating/closing accounts.
## Github Link: https://github.com/Dharmesh85/IT202-011/tree/prod/public_html/Project
## Project Board Link: https://github.com/Dharmesh85/IT202-011/projects/3
## Website Link: https://dbp64.herokuapp.com/Project/login.php
## Your Name: Dharmesh Patel

<!--
### Line item / Feature template (use this for each bullet point)
#### Don't delete this

- [ ] \(mm/dd/yyyy of completion) Feature Title (from the proposal bullet point, if it's a sub-point indent it properly)
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

- [x] (12/07/2021) User will be able to transfer between their accounts
  -  List of Evidence of Feature Completion
    - Status: Completed
    - Direct Link: https://dbp64.herokuapp.com/Project/transactions.php?type=transfer
      - PR link #1 https://github.com/Dharmesh85/IT202-011/pull/83
    - Screenshots
      - Screenshot #1 <img width="983" alt="Screen Shot 2021-12-10 at 10 10 14 PM" src="https://user-images.githubusercontent.com/77698793/145661796-812bdf9c-fb0d-4746-96bd-fa4b9ca1fa87.png">
        - Screenshot #1 Dropdown of source account and dest account; memo
      - Screenshot #2 <img width="868" alt="Screen Shot 2021-12-10 at 10 11 49 PM" src="https://user-images.githubusercontent.com/77698793/145661828-d80b78a4-e0ba-49ee-9791-c0f9fca60d16.png">
        - Screenshot #2  amount must be positive

- [x] (12/07/2021) Transaction History page
  -  List of Evidence of Feature Completion
    - Status: Partially working
    - Direct Link: https://dbp64.herokuapp.com/Project/view_transactions.php?id=1&page=1
    - Pull Requests
      - PR link #1 https://github.com/Dharmesh85/IT202-011/pull/80
    - Screenshots
      - Screenshot #1 <img width="1434" alt="Screen Shot 2021-12-10 at 10 51 58 PM" src="https://user-images.githubusercontent.com/77698793/145662812-cd232f35-7324-4c14-b483-d0351e9a5d08.png">
        - Screenshot #1 Move to different page after 10 transactions; show 10 latest transactions

- [x] (12/02/2021) User’s profile page should record/show First and Last name
  -  List of Evidence of Feature Completion
    - Status: Partially working
    - Direct Link: https://dbp64.herokuapp.com/Project/Profile.php
    - Pull Requests
      - PR link #1 https://github.com/Dharmesh85/IT202-011/pull/79
    - Screenshots
      - Screenshot #1 <img width="1440" alt="Screen Shot 2021-12-10 at 10 58 49 PM" src="https://user-images.githubusercontent.com/77698793/145662970-d77bbfa8-52eb-4a49-a0d2-b140959537fd.png">
        - Screenshot #1 edit name in profile page(issue in data base works on register page but not on profile)
      - Screenshot #2 <img width="1439" alt="Screen Shot 2021-12-10 at 10 59 32 PM" src="https://user-images.githubusercontent.com/77698793/145662992-48233245-02a7-4386-886a-a7834747250f.png">
        - Screenshot #2 add name when registering

- [x] \(12/10/2021) User will be able to transfer funds to another user’s account
  -  List of Evidence of Feature Completion
    - Status: Partially working 
    - Direct Link: https://dbp64.herokuapp.com/Project/transfer_other_acct.php
    - Pull Requests
      - PR link #1 https://github.com/Dharmesh85/IT202-011/pull/86
    - Screenshots
      - Screenshot #1 <img width="1440" alt="Screen Shot 2021-12-10 at 11 03 28 PM" src="https://user-images.githubusercontent.com/77698793/145663102-92127c93-b520-40d2-8288-46c2923fc142.png">
        - Screenshot #1 Transfer to other user account
      - Screenshot #2 <img width="690" alt="Screen Shot 2021-12-10 at 11 09 21 PM" src="https://user-images.githubusercontent.com/77698793/145663277-220168ff-bfcf-42e5-af78-6bffa1fab959.png">
        - Screenshot #2 Code used for transaction 

- Milestone 4
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