FROM python:3.12-slim

ARG TASK_NAME
ARG FLAG

RUN apt-get update && \
    apt-get install -y \
    libzbar0 \
    libgl1 \
    libglib2.0-0 curl && \
    apt-get clean && \
    rm -rf /var/lib/apt/lists/*

WORKDIR /apps/target

COPY requirements.txt .
COPY . .

ENV PYTHONUNBUFFERED=1 FLAG=$FLAG
RUN pip install --no-cache-dir -r requirements.txt

CMD ["python", "app.py"]
