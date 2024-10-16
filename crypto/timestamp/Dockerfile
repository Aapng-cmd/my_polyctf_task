FROM python:3.10

RUN apt-get update && apt-get install -y ncat

WORKDIR /app

COPY start.sh .
COPY main.py .
RUN chmod +x main.py

CMD ["bash", "start.sh"]
