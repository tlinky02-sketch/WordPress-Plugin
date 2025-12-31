---
description: Remove BOM from all PHP files to fix "unexpected output" WordPress error
---
# Remove BOM from PHP Files

Run this command after Antigravity edits PHP files to prevent the "3 characters of unexpected output" WordPress error:

// turbo
```powershell
cd C:\Users\PC 02\Desktop\ecom-guider\ecom-guider-plugin
Get-ChildItem -Path "." -Recurse -Filter "*.php" | ForEach-Object { $bytes = [System.IO.File]::ReadAllBytes($_.FullName); if ($bytes.Length -ge 3 -and $bytes[0] -eq 0xEF -and $bytes[1] -eq 0xBB -and $bytes[2] -eq 0xBF) { Write-Host "Removing BOM from: $($_.Name)"; $newBytes = New-Object byte[] ($bytes.Length - 3); [System.Array]::Copy($bytes, 3, $newBytes, 0, $bytes.Length - 3); [System.IO.File]::WriteAllBytes($_.FullName, $newBytes) } }; Write-Host "Done!"
```

## When to Run
- After Antigravity edits any PHP file
- Before deploying the plugin
- Whenever you see the "3 characters of unexpected output" error
