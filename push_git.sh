#!/bin/bash


check_variables() {
    if [ -z "$REPO_URL" ] || [ -z "$PROJECT_DIR" ]; then
        echo "Error: One or more required variables are not set."
        echo "Usage: $0 <repo_url> <project_dir> <commit_message>"
        echo "OR: $0 <repo_url> <project_dir>"
        echo "default commit message is 'Mid commit'"
        exit 1
    fi
}

# Set variables
REPO_URL=$1
PROJECT_DIR=$2
COMMIT=$3
CREDENTIALS_FILE="/root/git"

check_variables

# Change to the project directory
cd "$PROJECT_DIR" || { echo "Project directory not found"; exit 1; }

# Initialize a new Git repository if it doesn't exist
if [ ! -d ".git" ]; then
    git init
    git remote add origin "$REPO_URL"
    git branch -M main
    echo "Initialized a new Git repository."
fi

git add .

if [ -n "$3" ]; then
    COMMIT="$3"
else
    COMMIT="Mid commit"
fi

git commit -m "$COMMIT"


if [ -f "$CREDENTIALS_FILE" ]; then
    read -r GIT_CREDS < "$CREDENTIALS_FILE"
    GIT_USERNAME=$(echo $GIT_CREDS | cut -d ':' -f 1)
    GIT_PASSWORD=$(echo $GIT_CREDS | cut -d ':' -f 2)
    # echo "$GIT_USERNAME|$GIT_PASSWORD"
    REPO_TAIL=$(echo $REPO_URL | cut -d '/' -f 5)

    git push https://"$GIT_USERNAME":"$GIT_PASSWORD"@github.com/$GIT_USERNAME/$REPO_TAIL main
else
    echo "Credentials file not found."
    exit 1
fi

echo "Project pushed to GitHub successfully."
