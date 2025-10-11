$token=<PAT TOKEN>
$owner=<GITHUB USERNAME>
$repo=<REPO NAME>
$mergeMethod="rebase"

$response = Invoke-RestMethod `
    -Uri "https://api.github.com/repos/$owner/$repo/pulls?state=open&sort=updated&direction=desc&per_page=1" `
    -Headers @{
        "Authorization" = "token $token"
        "Accept" = "application/vnd.github+json"
    }

if ($response.Count -eq 0) {
    Write-Host "No open pull requests found."
    exit 1
}

$prNumber = $response[0].number
$branch = $response[0].head.ref
Write-Host "Latest open PR #: $prNumber (from branch: $branch)"

$mergeResponse = Invoke-RestMethod `
    -Method PUT `
    -Uri "https://api.github.com/repos/$owner/$repo/pulls/$prNumber/merge" `
    -Headers @{
        "Authorization" = "token $token"
        "Accept" = "application/vnd.github+json"
        "Content-Type" = "application/json"
    } `
    -Body (@{
        commit_title = "Auto-merge PR #$prNumber"
        merge_method = $mergeMethod
    } | ConvertTo-Json)

Write-Host "Merge response:"
Write-Output $mergeResponse