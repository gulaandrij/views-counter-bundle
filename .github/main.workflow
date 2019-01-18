workflow "New workflow" {
  on = "push"
  resolves = ["composer"]
}

action "composer" {
  uses = "actions/docker/cli@c08a5fc9e0286844156fefff2c141072048141f6"
  runs = "composer inst"
}
