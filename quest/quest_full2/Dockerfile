FROM ubuntu:20.04

# Set environment variables
ENV USERNAME=stitch
ENV USERHOME=/home/$USERNAME
ENV DEBIAN_FRONTEND=noninteractive

RUN apt-get update && apt-get install -y \
    libxml2-dev \
    libzip-dev \
    sudo \
    gcc \
    make \
    nano \
    openssh-server \
    strace \
    && rm -rf /var/lib/apt/lists/*

# Create a new user and set the home directory
RUN useradd -m -s /bin/bash $USERNAME

# Set passwords for the users
RUN echo "$USERNAME:solarsystem" | chpasswd
RUN echo 'root:aB3$dE!fG@hI#jK$lM%n^oP*qR&sT(u)V)wX+yZ' | chpasswd

# Configure SSH
RUN mkdir /var/run/sshd

# Allow root login and set the SSH port
RUN sed -i 's/#PermitRootLogin prohibit-password/PermitRootLogin yes/' /etc/ssh/sshd_config
RUN echo 'PermitRootLogin yes' >> /etc/ssh/sshd_config
RUN echo 'PasswordAuthentication yes' >> /etc/ssh/sshd_config

# Copy the source code for the inner program
COPY --chown=$USERNAME:$USERNAME src_inner/user_flag.txt /home/$USERNAME/flag.txt
COPY --chown=$USERNAME:$USERNAME src_inner/patch.py /opt/patch.py
RUN chmod +x /opt/patch.py
RUN chmod o-w /opt
RUN chmod a-w /opt/patch.py
RUN echo "stitch ALL=(ALL) NOPASSWD: /opt/patch.py" >> /etc/sudoers
COPY src_inner/root_flag.txt /root/flag.txt
# Expose the SSH port
#EXPOSE 22

# Start the SSH service
CMD ["/usr/sbin/sshd", "-D"]
