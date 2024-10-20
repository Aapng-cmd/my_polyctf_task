FROM ubuntu:20.04

RUN apt-get update && apt-get install -y ncat

ENV DEBIAN_FRONTEND=noninteractive

RUN apt-get update && apt-get install -y \
    build-essential \
    cmake \
    gdb \
    libc6-dbg \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*

RUN useradd -m -u 1001 user1001

RUN mkdir /opt/6c886709d856402fd7b3735a2a8a082a

WORKDIR /app

COPY ./src .

RUN cmake ./
RUN cmake -B build
RUN cmake --build build

RUN cp ./build/Lab1 /home/user1001/Lab1
RUN mv ./flag.txt /opt/6c886709d856402fd7b3735a2a8a082a/flag.txt
COPY ./start.sh /home/user1001/start.sh

EXPOSE 40912

CHOWN -R user1001:user1001 /home/user1001/Lab1

USER user1001
WORKDIR /home/user1001

CMD ["bash", "start.sh"]
