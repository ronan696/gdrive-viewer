# Z GDrive Viewer
*Z GDrive Viewer* is a simple PHP script to view/embed google drive folders that uses PHP Simple HTML DOM Parser (Author: S.C. Chen). This scripts displays folders and files in a grid view and provides direct download links for files as well as Google Docs. Unlike the tradition Google Drive embedding method, this script can open subfolders in the same window/iframe. *Z GDrive Viewer* does not require user to be logged in and **only** works on publicy shared folders.


### Requirements
Z GDrive Viewer requires PHP 5+.

### Getting Started
Open index.html and enter the __Folder ID__([:question:](https://s31.postimg.org/mfxmxstgr/image.jpg)).<br>Ensure that the folder is __Shared Publicly__([:question:](https://s32.postimg.org/4hwdggz39/sharing.gif))

### Embedding
For emdedding a Google Drive Folder, "z\_gdrive\_viewer\_static.php" script must be used (script should be edited to specify the Root Folder ID).
HTML iframe can be used to embed, as shown below.
```
<iframe src="PATH_TO_SCRIPT/z_gdrive_viewer_static.php?ID=ROOT_FOLDER_ID"></iframe>
```

-----
This Project is liscensed under MIT License.
