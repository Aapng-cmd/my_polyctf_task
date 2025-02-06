#!/bin/bash


images=$(docker images | grep -E "<none>|tmp" | cut -d " " -f 54)
echo $images
for im in $images; do
  docker rmi -f $im;
done

# for stoping networks
# docker network ls --filter "driver=bridge" --format "{{.Name}}" | xargs -r docker network rm
