DROP DATABASE Dotify;
CREATE DATABASE Dotify;
ALTER DATABSE Dotify CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE Dotify;

CREATE TABLE Dotify.User (
    UserId       INT                NOT NULL AUTO_INCREMENT,
    FirstName    CHAR(40)           NOT NULL,
    LastName     CHAR(40)           NOT NULL,
    Username     CHAR(40)           NOT NULL UNIQUE,
    Email        CHAR(40)           NOT NULL UNIQUE,
    PasswordHash CHAR(70) BINARY    NOT NULL,
    Admin        BOOLEAN            NULL DEFAULT false,
    CreatedTime  TIMESTAMP          NOT NULL DEFAULT CURRENT_TIMESTAMP,
    UpdatedTime  TIMESTAMP          NOT NULL DEFAULT CURRENT_TIMESTAMP,

    PRIMARY KEY (UserId)
);

CREATE TABLE Dotify.Song (
    SongId      INT          NOT NULL,
    AlbumId     INT          NOT NULL,
    ArtistId    INT          NOT NULL,
    Track       INT          NOT NULL,
    Title       CHAR(100)    NOT NULL,
    SongUrl     VARCHAR(250) NULL,
    CreatedTime  TIMESTAMP   NOT NULL DEFAULT CURRENT_TIMESTAMP,
    UpdatedTime  TIMESTAMP   NOT NULL DEFAULT CURRENT_TIMESTAMP,

    PRIMARY KEY (SongId, AlbumId, ArtistId)
);

CREATE TABLE Dotify.Album (
    AlbumId      INT         NOT NULL,
    ArtistId     INT         NOT NULL,
    Title        CHAR(60)    NOT NULL,
    RecordYear   CHAR(16)    NOT NULL,
    CreatedTime  TIMESTAMP   NOT NULL DEFAULT CURRENT_TIMESTAMP,
    UpdatedTime  TIMESTAMP   NOT NULL DEFAULT CURRENT_TIMESTAMP,

    PRIMARY KEY (AlbumId, ArtistId)
);

CREATE TABLE Dotify.Artist (
    ArtistId     INT         NOT NULL AUTO_INCREMENT,
    Name         CHAR(60)    NOT NULL,
    CreatedTime  TIMESTAMP   NOT NULL DEFAULT CURRENT_TIMESTAMP,
    UpdatedTime  TIMESTAMP   NOT NULL DEFAULT CURRENT_TIMESTAMP,

    PRIMARY KEY (ArtistId)
);
