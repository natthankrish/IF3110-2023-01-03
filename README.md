# IF3110-2023-01-03
# Moments

> Disusun untuk memenuhi Tugas Milestone 1 - IF3110 Pengembangan Aplikasi Berbasis Web

## Daftar Isi

-   [Deskripsi Aplikasi _Web_](#deskripsi-aplikasi-web)
-   [Struktur Program](#struktur-program)
-   [Daftar _Requirement_](#daftar-requirement)
-   [Cara Instalasi](#cara-instalasi)
-   [Cara Menjalankan _Server_](#cara-menjalankan-server)
-   [Screenshot Tampilan Aplikasi](#screenshot-tampilan-aplikasi)
-   [Entity Relationship Diagram](#entity-relationship-diagram)
-   [Pembagian Tugas](#pembagian-tugas)

## Deskripsi Aplikasi _Web_

**Moments** Begitu banyak moment penting dalam hidup yang layak untuk diingat, entah moment bahagia, senang, ataupun sedih. Moments hadir untuk masalah tersebut. Dengan aplikasi berbasis web ini, Anda dapaet mengabadikan moment penting dalam hidup Anda dengan sangat mudah. Aplikasi ini dikembangkan menggunakan DBMS (MySQL) dan PHP murni beserta HTML, CSS, dan Javascript vanilla.

## Struktur Program

```
.
│   .env.example
│   .gitignore
│   docker-compose.yml
│   Dockerfile
│   README.md
│
├───scripts
│       build-image.sh
│
└───src
    ├───app
    │   │   .htaccess
    │   │   init.php
    │   │
    │   ├───components
    │   │   ├───album
    │   │   │       AddAlbumPage.php
    │   │   │       AdminAlbumDetailPage.php
    │   │   │       AlbumListView.php
    │   │   │       UserAlbumDetailPage.php
    │   │   │
    │   │   ├───home
    │   │   │       HomePage.php
    │   │   │
    │   │   ├───not-found
    │   │   │       NotFoundPage.php
    │   │   │
    │   │   ├───song
    │   │   │       AddSongPage.php
    │   │   │       AdminSongDetailPage.php
    │   │   │       SearchPage.php
    │   │   │       UserSongDetailPage.php
    │   │   │
    │   │   ├───template
    │   │   │       Aside.php
    │   │   │       Navbar.php
    │   │   │
    │   │   └───user
    │   │           LoginPage.php
    │   │           RegisterPage.php
    │   │           UserListPage.php
    │   │
    │   ├───config
    │   │       config.php
    │   │
    │   ├───controllers
    │   │       AlbumController.php
    │   │       HomeController.php
    │   │       NotFoundController.php
    │   │       SongController.php
    │   │       UserController.php
    │   │
    │   ├───core
    │   │       App.php
    │   │       Controller.php
    │   │       Database.php
    │   │       MP3Access.php
    │   │       StorageAccess.php
    │   │       Tables.php
    │   │
    │   ├───exceptions
    │   │       LoggedException.php
    │   │
    │   ├───interfaces
    │   │       ControllerInterface.php
    │   │       ViewInterface.php
    │   │
    │   ├───middlewares
    │   │       AuthenticationMiddleware.php
    │   │       SongLimitMiddleware.php
    │   │       TokenMiddleware.php
    │   │
    │   ├───models
    │   │       AlbumModel.php
    │   │       SongModel.php
    │   │       UserModel.php
    │   │
    │   └───views
    │       ├───album
    │       │       AddAlbumView.php
    │       │       AdminAlbumDetailView.php
    │       │       AlbumListView.php
    │       │       UserAlbumDetailView.php
    │       │
    │       ├───home
    │       │       MainView.php
    │       │
    │       ├───not-found
    │       │       NotFoundView.php
    │       │
    │       ├───song
    │       │       AddSongView.php
    │       │       AdminSongDetailView.php
    │       │       SearchView.php
    │       │       UserSongDetailView.php
    │       │
    │       └───user
    │               LoginView.php
    │               RegisterView.php
    │               UserListView.php
    │
    ├───public
    │   │   .htaccess
    │   │   index.php
    │   │
    │   ├───images
    │   │   ├───assets
    │   │   │       arrow-left.svg
    │   │   │       arrow-right-white.svg
    │   │   │       arrow-right.svg
    │   │   │       bars.svg
    │   │   │       dropdown-arrow.svg
    │   │   │       logo-dark.svg
    │   │   │       logo-light.svg
    │   │   │       logo-notext-dark.svg
    │   │   │       sample.png
    │   │   │       search.svg
    │   │   │       user-solid.svg
    │   │   │
    │   │   └───icon
    │   │           android-chrome-192x192.png
    │   │           android-chrome-512x512.png
    │   │           apple-touch-icon.png
    │   │           favicon-16x16.png
    │   │           favicon-32x32.png
    │   │           favicon.ico
    │   │           site.webmanifest
    │   │
    │   ├───javascript
    │   │   ├───album
    │   │   │       add-album.js
    │   │   │       album-list.js
    │   │   │       update-album-detail.js
    │   │   │
    │   │   ├───component
    │   │   │       navbar.js
    │   │   │
    │   │   ├───home
    │   │   │       home.js
    │   │   │
    │   │   ├───lib
    │   │   │       debounce.js
    │   │   │
    │   │   ├───song
    │   │   │       add-song.js
    │   │   │       play-song.js
    │   │   │       search.js
    │   │   │       update-song.js
    │   │   │
    │   │   └───user
    │   │           login.js
    │   │           register.js
    │   │           user-list.js
    │   │
    │   └───styles
    │       ├───album
    │       │       add-album.css
    │       │       album-detail-admin.css
    │       │       album-detail.css
    │       │       album-list.css
    │       │
    │       ├───home
    │       │       home.css
    │       │
    │       ├───not-found
    │       │       not-found.css
    │       │
    │       ├───song
    │       │       add-song.css
    │       │       search.css
    │       │       song-detail-admin.css
    │       │       song-detail.css
    │       │
    │       ├───template
    │       │       aside.css
    │       │       globals.css
    │       │       navbar.css
    │       │
    │       └───user
    │               login.css
    │               register.css
    │               user-list.css
    │
    └───storage
        ├───images
        │       .gitkeep
        │
        └───songs
                .gitkeep
```

## Daftar _Requirement_

1. Login
2. Register
3. Home
4. Photos
5. Search
6. Feeds
7. Profil
8. Admin Dashboard
9. User Dashboard
10. User Management
11. Admin Detail
12. CRUD image, video

## Cara Instalasi

1. Lakukan pengunduhan _repository_ ini dengan menggunakan perintah `git clone https://github.com/natthankrish/IF3110-20230103.git` pada terminal komputer Anda.
2. Pastikan komputer Anda telah menginstalasi dan menjalankan aplikasi Docker.
3. Lakukan pembuatan _image_ Docker yang akan digunakan oleh aplikasi ini dengan menjalankan perintah `docker build -t tubes-1:latest .` pada terminal _directory_ aplikasi web.
4. Buatlah sebuah file `.env` yang bersesuaian dengan penggunaan (contoh file tersebut dapat dilihat pada `.env.example`).

## Cara Menjalankan _Server_

1. Anda dapat menjalankan program ini dengan menjalankan perintah `docker-compose up -d` pada terminal _directory_ aplikasi web.
2. Aplikasi web dapat diakses dengan menggunakan browser pada URL `http://localhost:8080/public/home`.
3. Aplikasi web dapat dihentikan dengan menjalankan perintah perintah `docker-compose down` pada terminal _directory_ aplikasi web.

## Screenshot Tampilan Aplikasi

### Login

![Login](https://github.com/natthankrish/IF3110-2023-01-03/assets/89324014/e061db4b-39c2-4740-9518-bdd58d99def9)

### Register

![Register](https://github.com/natthankrish/IF3110-2023-01-03/assets/89324014/a26da485-a074-4839-9ced-4c2a13bee684)


### Home

![Home](https://github.com/natthankrish/IF3110-2023-01-03/assets/89324014/1a903062-6089-4fa1-8106-c6a174eba6da)

### Photos

![Photos](./screenshots/list-album-1.png)

### Search

![Search](./screenshots/search-sort-filter-1.png)

### feeds

![Feeds](./screenshots/edit-song-1.png)


## _Entity Relationship Diagram_

![ERD](https://github.com/natthankrish/IF3110-2023-01-03/assets/89324014/a8013554-043c-4425-928e-7e67ecfd77c1)

## Pembagian Tugas

### _Server Side_

| Fitur                    | NIM      |
| ------------------------ | -------- |
| Login                    | 13520065 |
| Register                 | 13520065 |
| Home                     | 13520119 |
| Daftar Album             | 13520119 |
| Search, Sort, dan Filter | 13520101 |
| Edit Lagu                | 13520101 |
| Detail Lagu              | 13520101 |
| Edit Album               | 13520119 |
| Detail Album             | 13520119 |
| Tambah Lagu              | 13520101 |
| Tambah Album             | 13520119 |
| Daftar User              | 13520065 |

### _Client Side_

| Fitur                    | NIM      |
| ------------------------ | -------- |
| Login                    | 13520065 |
| Register                 | 13520065 |
| Home                     | 13520119 |
| Daftar Album             | 13520119 |
| Search, Sort, dan Filter | 13520101 |
| Edit Lagu                | 13520101 |
| Detail Lagu              | 13520101 |
| Edit Album               | 13520119 |
| Detail Album             | 13520119 |
| Tambah Lagu              | 13520101 |
| Tambah Album             | 13520119 |
| Daftar User              | 13520065 |
