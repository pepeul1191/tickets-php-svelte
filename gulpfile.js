function defaultTask(cb) {
  // place code for your default task here
  console.log('XD')
  console.log(process.env.NODE_ENV)
  console.log(process.env.NODE_ENV2)
  cb();
}

exports.default = defaultTask