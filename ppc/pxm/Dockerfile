FROM python:3.10

RUN apt-get update && \
    apt-get install -y ncat prettytable

WORKDIR /app

COPY start.sh .
COPY main.py .

CMD ["bash", "start.sh"]
