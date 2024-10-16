FROM python:3.11

RUN apt-get update && apt-get install -y ncat python3-prettytable

COPY requirements.txt .

RUN pip install --no-cache-dir --upgrade pip \
    && pip install --no-cache-dir -r requirements.txt
#     && pip install --no-cache-dir berserk prettytable && pip show berserk

# RUN pip3 install --no-cache-dir berserk


WORKDIR /app

COPY start.sh .
COPY main.py .
COPY chess.py .


# RUN wget https://github.com/rhgrant10/berserk/archive/refs/heads/master.zip
# RUN unzip master.zip
# RUN mv berserk-master berserk
# WORKDIR /app/berserk-master
# RUN python3 setup.py build
# RUN python3 setup.py install

WORKDIR /app

# RUN cp /usr/local/lib/python3.11/site-packages/berserk/* ./

# RUN export PYTHONPATH=$PYTHONPATH:/usr/local/lib/python3.11/site-packages/

RUN chmod +x main.py
RUN chmod +x chess.py
RUN chmod +x start.sh

CMD ["bash", "start.sh"]
