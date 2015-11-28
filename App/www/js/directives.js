angular.module('easyspa.directives', ['ngSanitize'])

.directive('stopEvent', function()
{
    return {
        restrict: 'A',
        link: function (scope, element, attr)
		{
            element.bind('click', function(e)
			{
                e.stopPropagation();
            });
        }
    };
})

.directive('errorSrc', function () {
  var errorSrc = {
    link: function postLink(scope, iElement, iAttrs) {
		if (!angular.element(iElement).attr('src'))
			angular.element(iElement).attr("src", iAttrs.errorSrc);
		iElement.bind('error', function() {
			angular.element(this).attr("src", iAttrs.errorSrc);
		});
    }
   }
   return errorSrc;
})

.directive('peeyLevelIonSlides', function ($timeout, $ionicScrollDelegate) {
  return {
    restrict: 'A',
    link: function (scope, element, attrs) {

      function resize () {
        $ionicScrollDelegate.resize()
      }

      scope.$watch(function () {
        var activeSlideElement = angular.element(element[0].getElementsByClassName(attrs.slideChildClass + "-active"))
        activeSlideElement.css('max-height', 'none')
        return angular.isDefined(activeSlideElement[0]) ? activeSlideElement[0].offsetHeight : 20
      }, function (newHeight) {
				console.log(newHeight);
        var sildeElements = angular.element(element[0].getElementsByClassName(attrs.slideChildClass))
				console.log(sildeElements);
        sildeElements.css('max-height', newHeight + 'px')
        resize()
        $timeout(resize)
        $timeout(resize, 50)
      })
    }
  }
});