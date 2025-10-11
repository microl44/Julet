
@echo off
setlocal

set TOKEN=%CPR_TOKEN%
set OWNER=%CPR_OWNER%
set REPO=%CPR_REPO%
set TITLE=%CPR_TITLE%
for /f %%b in ('git rev-parse --abbrev-ref HEAD') do set BRANCH_NAME=%%b
set BASE=%CPR_MAIN%
set "BODY=%CPR_BODY% -- Created by %USERNAME%"

curl -X POST https://api.github.com/repos/%OWNER%/%REPO%/pulls ^
  -H "Authorization: token %TOKEN%" ^
  -H "Accept: application/vnd.github+json" ^
  -H "Content-Type: application/json" ^
  -d "{\"title\":\"%TITLE%\",\"head\":\"%HEAD%\",\"base\":\"%BASE%\",\"body\":\"%BODY%\"}"

echo.
echo Pull request attempted.

pause