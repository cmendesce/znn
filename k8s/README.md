# Kubernetes version

`kubectl create secret generic mysql-pass --from-literal=password=znn_data`
`kubectl apply -f .`
`kubectl -n kube-system describe secret $(kubectl -n kube-system get secret | grep admin-user | awk '{print $1}')`

kubectl set image deployments/znn znn=cmendes/znn:text

kubectl set image deployments/znn znn=cmendes/znn:text

kubectl scale --replicas=5 deployments/znn

kubectl patch deployment znn \
        -p'{"spec":{"template":{"spec":{"containers":[{"name":"znn","image":"cmendes/znn:high"}]}}}}'


https://romain.dorgueil.net/blog/en/tips/2016/08/27/rollout-rollback-kubernetes-deployment.html


kubectl set image deployment.v1.apps/nginx-deployment nginx=nginx:1.9.1 --record



# Important! After this container has started, the PHP files
          # in our Docker image aren't in the shared volume. We need to 
          # get them into the shared volume. If we tried to write directly
          # to this volume from our Docker image the files wouldn't appear
          # in the nginx container.
          #
          # So, after the container has started, copy the PHP files from this
          # container's local filesystem (/app -- added via the Docker image) 
          # to the shared volume, which is mounted at /var/www/html.



        # Our nginx container, which uses the configuration declared above,
        # along with the files shared with the PHP-FPM app.