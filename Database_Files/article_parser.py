#!/usr/bin/env python3
# -*- coding: utf-8 -*-

import argparse
from collections import namedtuple
from datetime import datetime

Article = namedtuple('Article', ['section', 'body'])

parser = argparse.ArgumentParser()
parser.add_argument('file')
args = parser.parse_args()

articles = []
with open(args.file, 'r') as f:
    section = None
    body = []
    for line in f:
        line = line.strip()
        if line and section is None:
            section = line
        elif not line:
            articles.append(Article(section, body))
            section = None
            body = []
        elif line != '---':
            body.append(line)

id = 1
for title, body in articles:
    if title and body:
        body = " ".join(map(lambda line: bytes(line, 'utf-8').decode('utf-8', 'ignore'), body))
        body = ''.join(filter(lambda char: char.isprintable(), body))

        title = title.replace("'", "''")
        body = body.replace("'", "''")
        head = body[0:50]

        print(f"INSERT INTO Article(Title, Head) VALUE('{title}', '{head}');")
        print(f"INSERT INTO ArticleBody(ArticleId, body) VALUES({id}, '{body}');")

        id += 1
