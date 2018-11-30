#!/usr/bin/env python3

from glob import glob
from pprint import pprint
from collections import defaultdict
import sys

import eyed3
import os

class Song:
    def __init__(self, title, num, genre, path):
        self.title = title
        self.num = num
        self.genre = genre
        self.path = path

    def __repr__(self):
        return "Song({self.title}, {self.num}, {self.genre}, {self.path})".format(self=self)

metadata = defaultdict(lambda: defaultdict(lambda: {'year': 'Unknown', 'songs': []}))

music_files = glob("*.mp3")
for file in music_files:
    audio_tag = eyed3.load(file)

    artist = (audio_tag.tag.artist or "Unknown").replace("'", "''")
    album_artist = (audio_tag.tag.album_artist or "Unknown").replace("'", "''")

    album = (audio_tag.tag.album or "Unknown").replace("'", "''")
    title = (audio_tag.tag.title or "Unknown").replace("'", "''")
    track_num = audio_tag.tag.track_num[0] or 0
    genre = (str(audio_tag.tag.genre) or "Unknown").replace("'", "''")
    song_path = (os.path.realpath(file)).replace("'", "''")

    record_date = audio_tag.tag.getBestDate()
    if record_date is not None:
        record_date = record_date.year
    else:
        record_date = "Unknown"

    song = Song(title, track_num, genre, song_path)
    bandname = album_artist or artist
    metadata[bandname][album]['songs'].append(song)
    if metadata[bandname][album]['year'] == 'Unknown':
        metadata[bandname][album]['year'] = record_date

artist_id = 1
for artist, albums in metadata.items():
    print(f"INSERT INTO Dotify.Artist(Name) VALUES('{artist}');")
    album_id = 1
    for album, metadata in albums.items():
        print(artist_id, file=sys.stderr)
        year = metadata['year']
        print(f"INSERT INTO Dotify.Album(AlbumId, ArtistId, RecordYear, Title) VALUES({album_id}, {artist_id}, '{year}', '{album}');")
        song_id = 1
        for song in metadata['songs']:
            print(f"INSERT INTO Dotify.Song(SongId, AlbumId, ArtistId, Track, Title, SongUrl) VALUES({song_id}, {album_id}, {artist_id}, {song.num}, '{song.title}', '{song.path}');")
            song_id += 1
        album_id += 1
    artist_id += 1
