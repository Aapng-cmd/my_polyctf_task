FROM ubuntu:20.04

RUN apt-get update && apt-get install -y ncat

ENV DEBIAN_FRONTEND=noninteractive

RUN apt-get update && apt-get install -y \
    build-essential \
    gdb \
    libc6-dbg \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*

RUN useradd -m -u 1001 user1001

WORKDIR /home/user1001

COPY ./src .

RUN gcc -fno-stack-protector -z execstack -no-pie main.c -o task

COPY ./start.sh /home/user1001/start.sh
# COPY ./task /home/user1001/task

EXPOSE 40912

RUN chown -R user1001:user1001 /home/user1001/task

USER user1001
WORKDIR /home/user1001

COPY flag.txt ./

CMD ["bash", "start.sh"]
