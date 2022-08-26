
# MangoUploadPHP
Pure PHP, MySQL uploading application.





## Features

- Sharing Files Via Email/Sending Streight to account
- Live Previews & Full Screen Previews
- Link Sharing
- Folder & File Upload


## Deployment

To deploy this project run

```
Create A MySQL Database 
Database Name: mangozlogin
```

Users Table:
```
CREATE TABLE users (
	userId int (11) PRIMARY KEY AUTO_INCREMENT NOT NULL,
	usersName varchar(128) NOT NULL,
	usersEmail varchar(128) NOT NULL,
	usersUid varchar(128) NOT NULL,
	usersPwd varchar(128) NOT NULL
);
```

Folders Table:
```
CREATE TABLE folders (
	id int (11) PRIMARY KEY AUTO_INCREMENT NOT NULL,
	folderName varchar(128) NOT NULL,
	usersUid varchar(128) NOT NULL,
	sharing varchar(128) NOT NULL,
	publicView varchar(128) NOT NULL
);
```

Files Table:
```
CREATE TABLE class_files (
	id int (11) PRIMARY KEY AUTO_INCREMENT NOT NULL,
	name varchar(255) NOT NULL,
	size int (11) NOT NULL,
	downloads int (11) NOT NULL,
	usersid int (11) NOT NULL,
	datePublished varchar(128) NOT NULL,
	favourited varchar(128) NOT NULL,
	folderParent varchar(128) NOT NULL,
	publicView varchar(128) NOT NULL
);
```

Comments Table:
```
CREATE TABLE comments (
	id int (11) PRIMARY KEY AUTO_INCREMENT NOT NULL,
	comment varchar(255) NOT NULL,
	timePosted int (11) NOT NULL,
	linkedFile int (11) NOT NULL,
	publicity int (11) NOT NULL
);
```

Password Reset Table:
```
CREATE TABLE pwdReset (
	pwdResetId int(11) PRIMARY KEY AUTO_INCREMENT NOT NULL,
	pwdResetEmail TEXT NOT NULL,
	pwdResetSelector TEXT NOT NULL,
	pwdResetToken LONGTEXT NOT NULL,
	pwdResetExpires TEXT NOT NULL
);
```

Inbox/FileSharing Table:
```
CREATE TABLE inbox (
	Id int(11) PRIMARY KEY AUTO_INCREMENT NOT NULL,
	name varchar(128) NOT NULL,
	sentToUser varchar(128) NOT NULL,
	fromUser varchar(128) NOT NULL,
	size varchar(128) NOT NULL,
	usersid varchar(128) NOT NULL,
	dateRequest varchar(128) NOT NULL
);
```

ClientInfo & Logging:
```
CREATE TABLE client_info (
	id int(11) PRIMARY KEY AUTO_INCREMENT NOT NULL,
	ip varchar(128) NOT NULL,
	date_time varchar(128) NOT NULL,
	browser_name varchar(128) NOT NULL,
	browser_version varchar(128) NOT NULL,
	request_platform varchar(128) NOT NULL,
	user_agent varchar(128) NOT NULL,
	visited_page varchar(128) NOT NULL,
	user_login_id varchar(128) NOT NULL
);
```

