images=$(docker images | grep -E "<none>|tmp" | cut -d " " -f 54)
echo $images
for im in $images; do
  docker rmi -f $im;
done
