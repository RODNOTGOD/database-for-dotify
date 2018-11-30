#!/usr/bin/env python3
# -*- coding: utf-8 -*-

import subprocess as sp

usernames = ["masterdeaky", "pensiveturkey", "blandoismask", "hennessybrinkworth",
             "whereasmaxwell", "winisabella", "analoguetill", "birminghamyakama",
             "jappinessmiracle", "assistantzocket", "sandhillbrother", "maiseybender"]

names = ["Charlee Green", "Jameson Little", "Reuben Acevedo", "Branson Reed",
         "Kelton Moody", "Janae Gill", "Leo Bryan", "Semaj Guerra", "Luciano Carlson",
         "Harmony Pearson","Kendall Shaffer", "Lexie Patton"]


emails = ["arebenti@icloud.com", "alhajj@aol.com", "muzzy@sbcglobal.net", "flakeg@verizon.net",
          "afeldspar@icloud.com", "wilsonpm@att.net", "chaikin@me.com", "amimojo@msn.com",
          "jamuir@outlook.com", "gilmoure@att.net", "north@live.com", "tubajon@me.com"]

database = "Dotify"
table = "User"
password = "password"

for username, name, email in zip(usernames, names, emails):
    first, last = name.split()
    proc = sp.Popen(['htpasswd', '-bnBC', '10', '', password], stdout=sp.PIPE)
    proc.wait()
    hash = proc.communicate()[0].strip().decode()[1:]
    print(f"INSERT INTO {database}.{table}(Username, FirstName, LastName, Email, PasswordHash) VALUES('{username}', '{first}', '{last}', '{email}', '{hash}');")
