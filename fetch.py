import sys
import subprocess
import os
import time

class GitPipe():
    git_location = None
    git_branch = None 

    if sys.platform == "win32":
        platform = "windows"
    else:
        platform = "linux"

    JUL_ROOT = os.getenv('JUL_ROOT')

    def __init__(self, path=JUL_ROOT, account=[None, None]):
        with open(self.JUL_ROOT + '/.git/HEAD', 'r') as file:
            line = file.read().split('/')[-1].replace('\n', '')

        if line == "main":
            print("\nCurrent branch is MAIN. No issue can be fetched...\n")
            exit()

        res = subprocess.run(['powershell', self.JUL_ROOT + '/fetch.ps1', line], capture_output=True, shell=True, text=True)
        print("\n")
        print(res.stdout)

if __name__ == '__main__':
    gp = GitPipe()
