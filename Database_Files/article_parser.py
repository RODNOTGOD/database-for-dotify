#!/usr/bin/env python3
# -*- coding: utf-8 -*-

import argparse
import re
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
paragraph_re = re.compile(r'\s{3,}')
for title, body in articles:
    if title and body:
        title = "".join(map(lambda line: bytes(line, 'utf-8').decode('utf-8', 'ignore'), title))
        body = " ".join(body)

        title = title.replace("'", "''")
        body = body.replace("'", "''")
        body = body.replace("'", "''")
        paragraph_re.sub("<br/>", body)
        head = body[0:50]

        print(f"INSERT INTO Article(Title, Head) VALUE('{title}', '{head}');")
        print(f"INSERT INTO ArticleBody(ArticleId, body) VALUES({id}, '{body}');")

        id += 1
