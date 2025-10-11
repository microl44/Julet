
@echo off
setlocal

set TOKEN=<GITHUB SSH TOKEN>
set OWNER=<REPO OWNER>
set REPO=<REPO NAME>
set TITLE=<PR TITLE>
set HEAD=<BRANCH NAME>
set BASE=<MASTER BRANCH NAME>
set BODY=<PR MESSAGE>

curl -X POST https://api.github.com/repos/%OWNER%/%REPO%/pulls ^
  -H "Authorization: token %TOKEN%" ^
  -H "Accept: application/vnd.github+json" ^
  -H "Content-Type: application/json" ^
  -d "{\"title\":\"%TITLE%\",\"head\":\"%HEAD%\",\"base\":\"%BASE%\",\"body\":\"%BODY%\"}"

echo.
echo Pull request attempted.

pause