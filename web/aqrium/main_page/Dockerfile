FROM python:3.12-slim

ARG TASK_NAME
ARG FLASK_SECRET

RUN apt-get update && \
    apt-get install -y \
    libzbar0 \
    libgl1 \
    libglib2.0-0 curl && \
    apt-get clean && \
    rm -rf /var/lib/apt/lists/*

WORKDIR /apps/main

COPY requirements.txt .
COPY . .

ENV PYTHONUNBUFFERED=1 FLASK_SECRET=$FLASK_SECRET
RUN pip install --no-cache-dir -r requirements.txt

CMD ["python", "app.py"]
