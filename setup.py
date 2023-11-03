import os
import subprocess

def run_command(command, message):
    print(message)
    result = subprocess.run(command, capture_output=True, text=True)
    if result.returncode != 0:
        print(f"An error occurred: {result.stderr}")
        exit(1)

print("Welcome to the Triangle POS installer!")

# Get database credentials
db_name = input("Enter the name of the database you'd like to use: ")
db_user = input("Enter the username for the database: ")
db_password = input("Enter the password for the database: ")
db_host = input("Enter the host for the database (press Enter for 'localhost'): ") or "localhost"

# Install Composer dependencies
run_command(["composer", "install"], "Installing Composer dependencies...")

# Install npm packages and build assets
run_command(["npm", "install"], "Installing npm packages...")
run_command(["npm", "audit", "fix"], "Fixing npm vulnerabilities...")
run_command(["npm", "run", "dev"], "Building assets...")

# Append to .env file
print("Appending to .env file...")
with open(".env", "a") as f:
    f.write(f"\n# Appended by Triangle POS installer\n")
    f.write(f"DB_DATABASE={db_name}\n")
    f.write(f"DB_USERNAME={db_user}\n")
    f.write(f"DB_PASSWORD={db_password}\n")
    f.write(f"DB_HOST={db_host}\n")

# Generate app key and migrate database
run_command(["php", "artisan", "key:generate"], "Generating app key...")
run_command(["php", "artisan", "migrate", "--seed"], "Migrating database...")

# Start Laravel and Vite servers in the background
subprocess.Popen(["php", "artisan", "serve"])
subprocess.Popen(["npm", "run", "dev"])

print("\nTriangle POS installed successfully!")
