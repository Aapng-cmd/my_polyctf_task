FROM python:3.11

RUN apt-get update && apt-get install -y ncat


# RUN pip3 install --no-cache-dir berserk


WORKDIR /app

COPY start.sh .
COPY main.py .

WORKDIR /app

RUN chmod +x main.py
RUN chmod +x start.sh

CMD ["bash", "start.sh"]
