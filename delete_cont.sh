images=$(docker images | grep "<none>" | cut -d " " -f 51)
echo $images
for im in $images; do
  docker rmi -f $im;
done
