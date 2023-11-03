import os
import subprocess

# Define the directory and file names
workflows_dir = '.github/workflows'
workflow_file = 'visualizer.yml'
workflow_path = os.path.join(workflows_dir, workflow_file)

# The content of the GitHub Action configuration
workflow_content = """name: Generate repo visualization

on:
  push:
    branches:
      - main  # Set this to your default branch

jobs:
  build:
    runs-on: ubuntu-latest
    steps:
      - uses: actions/checkout@v2
      - uses: githubocto/repo-visualizer@main
        with:
          # Customize the behavior below
          root_path: "."  # Set this to the directory you want to visualize
"""

def create_workflow():
    # Check if the workflows directory exists, create it if not
    if not os.path.isdir(workflows_dir):
        os.makedirs(workflows_dir)
        print(f"Created directory: {workflows_dir}")

    # Create the workflow file with the content
    with open(workflow_path, 'w') as file:
        file.write(workflow_content)
        print(f"Created workflow file: {workflow_path}")

def git_commit_and_push():
    # Add the workflow file to git, commit, and push
    try:
        subprocess.check_call(['git', 'add', workflow_path])
        subprocess.check_call(['git', 'commit', '-m', 'Add repo-visualizer GitHub Action'])
        subprocess.check_call(['git', 'push'])
        print("Committed and pushed the workflow file to the repository.")
    except subprocess.CalledProcessError as e:
        print("An error occurred while committing and pushing the changes.")
        print(e)

if __name__ == "__main__":
    create_workflow()
    
    # Uncomment the line below to enable automatic committing
    git_commit_and_push()
