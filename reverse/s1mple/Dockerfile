FROM ubuntu:20.04

RUN apt-get update && apt-get install -y ncat

ENV DEBIAN_FRONTEND=noninteractive

RUN apt-get update && apt-get install -y \
    build-essential \
    cmake \
    gdb \
    gcc \
    libc6-dbg \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*

RUN useradd -m -u 1001 user1001

WORKDIR /app

COPY ./src .

EXPOSE 40912

# RUN chown -R user1001:user1001 /home/user1001/*

COPY start.sh /home/user1001

USER user1001
WORKDIR /home/user1001

RUN gcc -fno-stack-protector -z execstack -no-pie -o ./task /app/task.c

CMD ["bash", "start.sh"]
