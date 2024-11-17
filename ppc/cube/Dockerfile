FROM python:3.11

RUN apt-get update && apt-get install -y ncat python3-prettytable nano

COPY requirements.txt .

RUN pip install --no-cache-dir --upgrade pip \
    && pip install --no-cache-dir -r requirements.txt


WORKDIR /app

COPY start.sh .
COPY main.py .

WORKDIR /app


RUN chmod +x main.py
RUN chmod +x start.sh

CMD ["bash", "start.sh"]
