#!/usr/bin/env python3
import tkinter as tk
from tkinter import filedialog, messagebox
import subprocess
import time
import os
import webbrowser

class RepoVisualizerGUI(tk.Tk):
    def __init__(self):
        super().__init__()
        self.title('Repository Visualizer')
        self.geometry('300x150')
        
        # Create a button to run the visualizer
        self.visualize_button = tk.Button(self, text='Visualize Repository', command=self.run_visualizer)
        self.visualize_button.pack(pady=10)
        
        # Create a button to open the SVG
        self.open_svg_button = tk.Button(self, text='Open SVG', command=self.open_svg)
        self.open_svg_button.pack(pady=10)
        
        # Disable the open button until visualization is complete
        self.open_svg_button['state'] = 'disabled'
        
        # Path to the generated SVG
        self.svg_path = None

    def run_visualizer(self):
        # Ask user to select the repository directory
        repo_dir = filedialog.askdirectory(title='Select Repository Directory')
        if not repo_dir:
            return
        
        # Run the visualizer GitHub Action (assuming the action is set up in the repo)
        try:
            subprocess.check_call(['git', 'pull'], cwd=repo_dir)
            subprocess.check_call(['git', 'add', '.'], cwd=repo_dir)
            subprocess.check_call(['git', 'commit', '-m', 'Update repository visualization'], cwd=repo_dir)
            subprocess.check_call(['git', 'push'], cwd=repo_dir)
            messagebox.showinfo('Success', 'Repository visualization updated and pushed to remote.')
            
            # Wait for GitHub Action to complete (this is a naive wait, GitHub Actions can take variable time)
            time.sleep(60)  # Wait for 1 minute (adjust as necessary)
            
            # Pull the changes from the repository
            subprocess.check_call(['git', 'pull'], cwd=repo_dir)
            
            # Assuming the SVG is named 'diagram.svg' and placed in the root of the repo
            self.svg_path = os.path.join(repo_dir, 'diagram.svg')
            if os.path.exists(self.svg_path):
                self.open_svg_button['state'] = 'normal'  # Enable the button to open the SVG
            else:
                messagebox.showwarning('Warning', 'SVG file not found. Check if GitHub Action completed successfully.')
        except subprocess.CalledProcessError as e:
            messagebox.showerror('Error', 'An error occurred while visualizing the repository.')
            print(e)

    def open_svg(self):
        if self.svg_path and os.path.exists(self.svg_path):
            webbrowser.open(self.svg_path)
        else:
            messagebox.showerror('Error', 'SVG file does not exist. Please run the visualizer first.')

if __name__ == '__main__':
    app = RepoVisualizerGUI()
    app.mainloop()

