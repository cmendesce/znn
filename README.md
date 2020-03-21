# Kube-znn 

Kube-ZNN is a deployment of the tradicional znn exemplar system for Kubernetes. 

## Getting started

Make sure you have access to a running Kubernetes cluster and the `kubectl` on your `PATH`. 

Just run `kubectl apply -f .` in this folder and open [http://localhost:8080/news.php](http://localhost:8080/news.php) in your browser.

## Architecture

![kube-znn architecture](kube-znn-v2.jpg)

### Containers

Each application is composed by two containers. 


#### How it works

Znn and OpenResty share a volume called `shared-files`, mounted at `/var/www/html` in both containers. After the znn container has started, it's necessary to copy the `php` files from the container's local filesystem `/www` to that shared volume. On the OpenResty side, in its configuration file, the mounted folder represents the root folder which is served on port 80.

**ZNN**

**OpenResty**

[OpenResty®](https://openresty.org/) is a full-fledged web platform that integrates many enhanced made by taking advantage of various well-designed Nginx modules.


**MySQL**


### Prometheus integration

The web applications served by a traditional LEMP stack (Linux, NGINX, MySQL, PHP) does not 
work well when the developers want to use  Prometheus to monitor performance metrics. The 
reason for this is that a PHP  application typically does not track metrics like the amount 
of processed requests or the average request time (or would need to gather this data by 
itself and then persist it in a database).

### Pages

* **news.php** It's the same as its original version, just a few improvements on html structure.
* **liveness.php**
* **readiness.php**


### Fidelity levels

The original Znn implements three levels of fidelity for responses sent to client applications: high, which include content with high resolution images; low, which include only low resolution images; and textual, which do not include any images in its response.

**Switching between versions**

Performing a Kubernetes Rolling Update is the best way to switch between those versions ([see more](https://kubernetes.io/docs/tutorials/kubernetes-basics/update/update-intro/)).

Switch to **high level**: 
```bash
kubectl set image deployments/kube-znn znn=cmendes/znn:high
```

Switch to **low level**: 
```bash
kubectl set image deployments/kube-znn znn=cmendes/znn:low
```

Switch to **text level**: 
```bash
kubectl set image deployments/kube-znn znn=cmendes/znn:text
```