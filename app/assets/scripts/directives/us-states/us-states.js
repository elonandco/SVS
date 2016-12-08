
/**
 * Directive for outputting and handling a dropdown of US States.
 *
 * @author James Huston <jhuston@redventures.com>
 * @since 2013-07-10
 */

angular.module('SVS.directives')

.directive('usStates', function() {
  return {
    restrict: 'EA',
    scope: {
        selectedState: '=state'
    },
    template: '<select ng-options="state as state for state in states" class="us-states" ng-model="selectedState"><option value="">{{ emptyName }}</option></select>',
    replace: true,

    link: function ($scope, element, attributes) {
      $scope.emptyName = attributes.emptyname || 'Select State';
    },

    controller: [ "$scope", function ($scope) {
      $scope.states = ["AK","AL","AR","AZ","CA","CO","CT","DC","DE","FL","GA","GU","HI","IA","ID", "IL","IN","KS","KY","LA","MA","MD","ME","MH","MI","MN","MO","MS","MT","NC","ND","NE","NH","NJ","NM","NV","NY", "OH","OK","OR","PA","PR","PW","RI","SC","SD","TN","TX","UT","VA","VI","VT","WA","WI","WV","WY"]
    }]

  };
});