import sys
import subprocess
import os
import time

class GitPipe():
    git_location = None
    git_branch = None 

    def __init__(self, path='C:/xampp/htdocs/Julet', account=[None, None]):
        with open('c:/xampp/htdocs/Julet/.git/HEAD', 'r') as file:
            line = file.read().split('/')[-1].replace('\n', '')
        
        if line == "main":
            print("\nCurrent branch is MAIN. No issue can be fetched...\n")
            exit()
        
        res = subprocess.run(['powershell', 'c:/xampp/htdocs/Julet/fetch.ps1', line], capture_output=True, shell=True, text=True)
        print("\n")
        print(res.stdout)

if __name__ == '__main__':
    gp = GitPipe()